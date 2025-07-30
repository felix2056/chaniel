/**
 * Content Editor System for CHANEL x LEE JUN HO Website
 * Handles inline editing, modal interactions, and API communication
 */

class ContentEditor {
    constructor() {
        this.isAdminMode = false;
        this.currentEditingElement = null;
        this.apiEndpoint = '/api/content.php';
        this.isAuthenticated = this.checkAdminAuth();
        this.init();
    }

    init() {
        // Only initialize if user is authenticated or if admin mode is enabled via URL
        if (this.isAuthenticated || this.isAdminModeEnabled()) {
            this.createAdminToggle();
            this.createModal();
            this.bindEvents();
            this.loadContentFromDatabase();
        }
    }

    checkAdminAuth() {
        // Check if admin session exists (this would be set by PHP)
        // For now, we'll check URL parameters
        return this.isAdminModeEnabled();
    }

    isAdminModeEnabled() {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get('admin') === '1';
    }

    createAdminToggle() {
        const toggle = document.createElement('button');
        toggle.className = 'admin-toggle';
        toggle.innerHTML = '🔧 Admin Mode';
        toggle.addEventListener('click', () => this.toggleAdminMode());
        document.body.appendChild(toggle);
    }

    createModal() {
        const modal = document.createElement('div');
        modal.className = 'editor-modal';
        modal.innerHTML = `
            <div class="editor-modal-content">
                <div class="editor-modal-header">
                    <h3 class="editor-modal-title">Edit Content</h3>
                    <button class="editor-modal-close">&times;</button>
                </div>
                <div class="editor-message" style="display: none;"></div>
                <form class="editor-form">
                    <div class="editor-form-group">
                        <label class="editor-label" for="editor-content">Content</label>
                        <textarea class="editor-textarea" id="editor-content" placeholder="Enter content..."></textarea>
                    </div>
                    <div class="editor-buttons">
                        <button type="button" class="editor-btn editor-btn-secondary" data-action="cancel">Cancel</button>
                        <button type="submit" class="editor-btn editor-btn-primary" data-action="save">
                            <span class="editor-loading" style="display: none;"></span>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        `;
        document.body.appendChild(modal);
        this.modal = modal;
    }

    bindEvents() {
        // Modal events
        this.modal.querySelector('.editor-modal-close').addEventListener('click', () => this.closeModal());
        this.modal.querySelector('[data-action="cancel"]').addEventListener('click', () => this.closeModal());
        this.modal.querySelector('.editor-form').addEventListener('submit', (e) => this.handleSave(e));

        // Close modal on backdrop click
        this.modal.addEventListener('click', (e) => {
            if (e.target === this.modal) this.closeModal();
        });

        // Escape key to close modal
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.modal.classList.contains('active')) {
                this.closeModal();
            }
        });
    }

    toggleAdminMode() {
        this.isAdminMode = !this.isAdminMode;
        const toggle = document.querySelector('.admin-toggle');
        
        if (this.isAdminMode) {
            document.body.classList.add('admin-mode');
            toggle.classList.add('active');
            toggle.innerHTML = '🔒 Exit Admin';
            this.makeElementsEditable();
        } else {
            document.body.classList.remove('admin-mode');
            toggle.classList.remove('active');
            toggle.innerHTML = '🔧 Admin Mode';
            this.removeEditableElements();
        }
    }

    makeElementsEditable() {
        // Define editable elements with their selectors and content types
        const editableElements = [
            // Hero Section
            { selector: '.hero .section-title h3', type: 'text', id: 'hero-subtitle' },
            { selector: '.hero .section-title h1', type: 'text', id: 'hero-title' },
            { selector: '.hero .section-title p', type: 'text', id: 'hero-description' },
            { selector: '.hero .hero-btn .btn-highlighted', type: 'text', id: 'hero-btn-primary' },
            { selector: '.hero .hero-btn .btn-default:not(.btn-highlighted)', type: 'text', id: 'hero-btn-secondary' },
            { selector: '.hero.hero-video', type: 'url', id: 'hero-video-url' },

            // About/Collaboration Section
            { selector: '.about-us .section-title h3', type: 'text', id: 'about-subtitle' },
            { selector: '.about-us .section-title h2', type: 'text', id: 'about-title' },
            { selector: '.about-us .section-title-content p', type: 'text', id: 'about-description' },
            { selector: '.about-us .section-btn .btn-default', type: 'text', id: 'about-btn' },

            // Counter Items
            { selector: '.about-counter-item:nth-child(1) .counter', type: 'number', id: 'counter-1-value' },
            { selector: '.about-counter-item:nth-child(1) h3', type: 'text', id: 'counter-1-label' },
            { selector: '.about-counter-item:nth-child(2) .counter', type: 'number', id: 'counter-2-value' },
            { selector: '.about-counter-item:nth-child(2) h3', type: 'text', id: 'counter-2-label' },
            { selector: '.about-counter-item:nth-child(3) .counter', type: 'number', id: 'counter-3-value' },
            { selector: '.about-counter-item:nth-child(3) h3', type: 'text', id: 'counter-3-label' },
            { selector: '.about-counter-item:nth-child(4) .counter', type: 'number', id: 'counter-4-value' },
            { selector: '.about-counter-item:nth-child(4) h3', type: 'text', id: 'counter-4-label' },

            // Team Section
            { selector: '.our-team .section-title h3', type: 'text', id: 'team-subtitle' },
            { selector: '.our-team .section-title h2', type: 'text', id: 'team-title' },
            { selector: '.section-footer-btn .btn-default', type: 'text', id: 'team-btn' },

            // Team Members
            { selector: '.team-item:nth-child(1) .team-content h3 a', type: 'text', id: 'team-member-1-name' },
            { selector: '.team-item:nth-child(1) .team-content p', type: 'text', id: 'team-member-1-role' },
            { selector: '.team-item:nth-child(1) .yield-indicator', type: 'text', id: 'team-member-1-indicator' },
            { selector: '.team-item:nth-child(2) .team-content h3 a', type: 'text', id: 'team-member-2-name' },
            { selector: '.team-item:nth-child(2) .team-content p', type: 'text', id: 'team-member-2-role' },
            { selector: '.team-item:nth-child(2) .yield-indicator', type: 'text', id: 'team-member-2-indicator' },
            { selector: '.team-item:nth-child(3) .team-content h3 a', type: 'text', id: 'team-member-3-name' },
            { selector: '.team-item:nth-child(3) .team-content p', type: 'text', id: 'team-member-3-role' },
            { selector: '.team-item:nth-child(3) .yield-indicator', type: 'text', id: 'team-member-3-indicator' },
            { selector: '.team-item:nth-child(4) .team-content h3 a', type: 'text', id: 'team-member-4-name' },
            { selector: '.team-item:nth-child(4) .team-content p', type: 'text', id: 'team-member-4-role' },
            { selector: '.team-item:nth-child(4) .yield-indicator', type: 'text', id: 'team-member-4-indicator' },

            // Partnership Showcase
            { selector: '.intro-video .section-title h3', type: 'text', id: 'showcase-subtitle' },
            { selector: '.intro-video .section-title h2', type: 'text', id: 'showcase-title' },
            { selector: '.intro-video .popup-video', type: 'url', id: 'showcase-video-url' },

            // Gallery Section
            { selector: '.our-gallery .section-title h3', type: 'text', id: 'gallery-subtitle' },
            { selector: '.our-gallery .section-title h2', type: 'text', id: 'gallery-title' },

            // Testimonials Section
            { selector: '.our-testimonial .section-title h3', type: 'text', id: 'testimonials-subtitle' },
            { selector: '.our-testimonial .section-title h2', type: 'text', id: 'testimonials-title' },
            { selector: '.testimonial-item:nth-child(1) .testimonial-content p', type: 'text', id: 'testimonial-1-content' },
            { selector: '.testimonial-item:nth-child(1) .author-content h3', type: 'text', id: 'testimonial-1-author' },
            { selector: '.testimonial-item:nth-child(2) .testimonial-content p', type: 'text', id: 'testimonial-2-content' },
            { selector: '.testimonial-item:nth-child(2) .author-content h3', type: 'text', id: 'testimonial-2-author' },
            { selector: '.testimonial-item:nth-child(3) .testimonial-content p', type: 'text', id: 'testimonial-3-content' },
            { selector: '.testimonial-item:nth-child(3) .author-content h3', type: 'text', id: 'testimonial-3-author' },

            // Blog Section
            { selector: '.our-blog .section-title h3', type: 'text', id: 'blog-subtitle' },
            { selector: '.our-blog .section-title h2', type: 'text', id: 'blog-title' },
            { selector: '.post-item:nth-child(1) .post-item-content h3 a', type: 'text', id: 'blog-post-1-title' },
            { selector: '.post-item:nth-child(1) .post-meta ul li:first-child', type: 'text', id: 'blog-post-1-author' },
            { selector: '.post-item:nth-child(1) .post-meta ul li:last-child', type: 'text', id: 'blog-post-1-date' },
            { selector: '.post-item:nth-child(2) .post-item-content h3 a', type: 'text', id: 'blog-post-2-title' },
            { selector: '.post-item:nth-child(2) .post-meta ul li:first-child', type: 'text', id: 'blog-post-2-author' },
            { selector: '.post-item:nth-child(2) .post-meta ul li:last-child', type: 'text', id: 'blog-post-2-date' },
            { selector: '.post-item:nth-child(3) .post-item-content h3 a', type: 'text', id: 'blog-post-3-title' },
            { selector: '.post-item:nth-child(3) .post-meta ul li:first-child', type: 'text', id: 'blog-post-3-author' },
            { selector: '.post-item:nth-child(3) .post-meta ul li:last-child', type: 'text', id: 'blog-post-3-date' },

            // CTA Section
            { selector: '.cta-box .section-title h2', type: 'text', id: 'cta-title' },
            { selector: '.cta-box .section-btn .btn-default', type: 'text', id: 'cta-btn' },

            // Footer Section
            { selector: '.footer-contact-box ul li:first-child', type: 'text', id: 'footer-address' },
            { selector: '.footer-contact-box ul li:nth-child(2) a', type: 'email', id: 'footer-email' },
            { selector: '.footer-contact-box ul li:nth-child(3) a', type: 'phone', id: 'footer-phone' },
            { selector: '.footer-links:nth-child(3) p', type: 'text', id: 'footer-newsletter' },
            { selector: '.footer-copyright-text p', type: 'text', id: 'footer-copyright' }
        ];

        editableElements.forEach(config => {
            const element = document.querySelector(config.selector);
            if (element) {
                element.classList.add('editable-element');
                element.setAttribute('data-editor-id', config.id);
                element.setAttribute('data-editor-type', config.type);
                element.addEventListener('click', (e) => this.handleElementClick(e, config));
            }
        });
    }

    removeEditableElements() {
        const editableElements = document.querySelectorAll('.editable-element');
        editableElements.forEach(element => {
            element.classList.remove('editable-element');
            element.removeAttribute('data-editor-id');
            element.removeAttribute('data-editor-type');
            element.removeEventListener('click', this.handleElementClick);
        });
    }

    handleElementClick(e, config) {
        if (!this.isAdminMode) return;
        
        e.preventDefault();
        e.stopPropagation();
        
        // Special handling for hero video container
        if (config.id === 'hero-video-url') {
            // For hero video, we want to edit the YouTube URL
            this.currentEditingElement = {
                element: e.target,
                config: config
            };
        } else {
            // For other elements, use the clicked element
            this.currentEditingElement = {
                element: e.target,
                config: config
            };
        }
        
        this.openModal(config);
    }

    openModal(config) {
        const modal = this.modal;
        const title = modal.querySelector('.editor-modal-title');
        const textarea = modal.querySelector('#editor-content');
        const label = modal.querySelector('.editor-label');

        // Set modal title and label
        title.textContent = `Edit ${config.id.replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase())}`;
        label.textContent = this.getLabelForType(config.type);

        // Get current content
        let currentContent = '';
        if (config.type === 'url') {
            if (config.id === 'hero-video-url') {
                // For hero video, get the YouTube video ID and convert to full URL
                const heroVideo = document.querySelector('#herovideo');
                if (heroVideo) {
                    const dataProperty = heroVideo.getAttribute('data-property');
                    if (dataProperty) {
                        const match = dataProperty.match(/videoURL:'([^']+)'/);
                        const videoId = match ? match[1] : '';
                        // Convert video ID to full YouTube URL for user editing
                        currentContent = videoId ? `https://www.youtube.com/watch?v=${videoId}` : '';
                    }
                }
            } else {
                currentContent = this.currentEditingElement.element.getAttribute('href') || 
                               this.currentEditingElement.element.getAttribute('data-property') || '';
            }
        } else if (config.type === 'number') {
            currentContent = this.currentEditingElement.element.textContent;
        } else {
            currentContent = this.currentEditingElement.element.textContent;
        }

        textarea.value = currentContent;
        modal.classList.add('active');
        textarea.focus();
    }

    closeModal() {
        this.modal.classList.remove('active');
        this.currentEditingElement = null;
        this.hideMessage();
    }

    getLabelForType(type) {
        const labels = {
            'text': 'Text Content',
            'url': 'URL/Link',
            'email': 'Email Address',
            'phone': 'Phone Number',
            'number': 'Number Value'
        };
        
        // Special label for hero video URL
        if (this.currentEditingElement && this.currentEditingElement.config.id === 'hero-video-url') {
            return 'YouTube Video URL (e.g., https://www.youtube.com/watch?v=VIDEO_ID)';
        }
        
        return labels[type] || 'Content';
    }

    async handleSave(e) {
        e.preventDefault();
        
        if (!this.currentEditingElement) return;

        const saveBtn = e.target.querySelector('[data-action="save"]');
        const loading = saveBtn.querySelector('.editor-loading');
        const textarea = this.modal.querySelector('#editor-content');
        const content = textarea.value.trim();

        if (!content) {
            this.showMessage('Content cannot be empty', 'error');
            return;
        }

        // Show loading state
        saveBtn.disabled = true;
        loading.style.display = 'inline-block';
        saveBtn.textContent = 'Saving...';

        try {
            // For hero video URL, extract video ID before saving
            let contentToSave = content;
            if (this.currentEditingElement.config.id === 'hero-video-url') {
                const videoId = this.extractYouTubeId(content);
                if (!videoId) {
                    this.showMessage('Please enter a valid YouTube URL', 'error');
                    return;
                }
                contentToSave = videoId; // Save only the video ID to database
            }

            const response = await this.saveContent({
                elementId: this.currentEditingElement.config.id,
                contentType: this.currentEditingElement.config.type,
                content: contentToSave
            });

            if (response.success) {
                this.updateElementContent(contentToSave);
                this.showMessage('Content saved successfully!', 'success');
                setTimeout(() => this.closeModal(), 1500);
            } else {
                this.showMessage(response.message || 'Failed to save content', 'error');
            }
        } catch (error) {
            console.error('Save error:', error);
            this.showMessage('Network error. Please try again.', 'error');
        } finally {
            // Reset button state
            saveBtn.disabled = false;
            loading.style.display = 'none';
            saveBtn.innerHTML = '<span class="editor-loading" style="display: none;"></span>Save Changes';
        }
    }

    updateElementContent(content) {
        const { element, config } = this.currentEditingElement;
        
        if (config.type === 'url') {
            if (config.id === 'hero-video-url') {
                // Update YouTube video URL - find the actual hero video element
                const heroVideo = document.querySelector('#herovideo');
                if (heroVideo) {
                    // Content is already a video ID (extracted in handleSave)
                    const videoId = content;
                    if (videoId) {
                        heroVideo.setAttribute('data-property', 
                            `{videoURL:'${videoId}',containment:'.hero-video', showControls:false, autoPlay:true, loop:true, vol:0, mute:false, startAt:0, stopAt:296, opacity:1, addRaster:true, quality:'large', optimizeDisplay:true}`);
                        
                        // Reload the YouTube player if it exists
                        if (window.YTPlayer) {
                            window.YTPlayer.reload();
                        }
                    }
                }
            } else {
                element.setAttribute('href', content);
            }
        } else if (config.type === 'number') {
            element.textContent = content;
        } else {
            element.textContent = content;
        }
    }

    extractYouTubeId(url) {
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
        const match = url.match(regExp);
        return (match && match[2].length === 11) ? match[2] : null;
    }

    async saveContent(data) {
        const response = await fetch(this.apiEndpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });

        return await response.json();
    }

    async loadContentFromDatabase() {
        try {
            const response = await fetch(`${this.apiEndpoint}?action=getAll`);
            const data = await response.json();
            
            if (data.success && data.content) {
                data.content.forEach(item => {
                    this.updateElementFromDatabase(item);
                });
            }
        } catch (error) {
            console.error('Failed to load content from database:', error);
        }
    }

    updateElementFromDatabase(item) {
        const element = document.querySelector(`[data-editor-id="${item.element_id}"]`);
        if (element) {
            // Create a temporary editing context for database updates
            const tempContext = {
                element: element,
                config: {
                    type: item.content_type,
                    id: item.element_id
                }
            };
            
            // Store current context and temporarily set new one
            const originalContext = this.currentEditingElement;
            this.currentEditingElement = tempContext;
            
            // Update the content
            this.updateElementContent(item.content);
            
            // Restore original context
            this.currentEditingElement = originalContext;
        }
    }

    showMessage(message, type) {
        const messageEl = this.modal.querySelector('.editor-message');
        messageEl.textContent = message;
        messageEl.className = `editor-message ${type}`;
        messageEl.style.display = 'block';
    }

    hideMessage() {
        const messageEl = this.modal.querySelector('.editor-message');
        messageEl.style.display = 'none';
    }
}

// Initialize the content editor when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.contentEditor = new ContentEditor();
}); 