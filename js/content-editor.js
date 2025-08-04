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
                    <!-- Single field form (default) -->
                    <div class="editor-form-group" id="single-field-group">
                        <label class="editor-label" for="editor-content">Content</label>
                        <textarea class="editor-textarea" id="editor-content" placeholder="Enter content..."></textarea>
                    </div>
                    
                    <!-- Dual field form (for URL elements) -->
                    <div class="editor-form-group" id="dual-field-group" style="display: none;">
                        <div class="editor-form-row">
                            <div class="editor-form-col">
                                <label class="editor-label" for="editor-text-content">Button Text</label>
                                <input type="text" class="editor-input" id="editor-text-content" placeholder="Enter button text...">
                            </div>
                            <div class="editor-form-col">
                                <label class="editor-label" for="editor-url-content">URL/Link</label>
                                <input type="url" class="editor-input" id="editor-url-content" placeholder="Enter URL...">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Image upload form -->
                    <div class="editor-form-group" id="image-field-group" style="display: none;">
                        <div class="editor-image-preview">
                            <img id="editor-image-preview" src="" alt="Preview" style="display: none;">
                        </div>
                        <div class="editor-form-row">
                            <div class="editor-form-col">
                                <label class="editor-label" for="editor-image-file">Upload New Image</label>
                                <input type="file" class="editor-input" id="editor-image-file" accept="image/*">
                            </div>
                            <div class="editor-form-col">
                                <label class="editor-label" for="editor-image-alt">Alt Text</label>
                                <input type="text" class="editor-input" id="editor-image-alt" placeholder="Enter alt text...">
                            </div>
                        </div>
                        <div class="editor-form-row">
                            <div class="editor-form-col">
                                <label class="editor-label" for="editor-image-url">Or Enter Image URL</label>
                                <input type="url" class="editor-input" id="editor-image-url" placeholder="Enter image URL...">
                            </div>
                        </div>
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
        // Find all elements with data-editor-id attributes and make them editable
        const editableElements = document.querySelectorAll('[data-editor-id]');
        
        editableElements.forEach(element => {
            const editorId = element.getAttribute('data-editor-id');
            const editorType = element.getAttribute('data-editor-type');
            
            if (editorId && editorType) {
                element.classList.add('editable-element');
                
                const config = {
                    id: editorId,
                    type: editorType
                };
                
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
        const singleFieldGroup = modal.querySelector('#single-field-group');
        const dualFieldGroup = modal.querySelector('#dual-field-group');
        const imageFieldGroup = modal.querySelector('#image-field-group');
        const textarea = modal.querySelector('#editor-content');
        const textInput = modal.querySelector('#editor-text-content');
        const urlInput = modal.querySelector('#editor-url-content');
        const imageFileInput = modal.querySelector('#editor-image-file');
        const imageAltInput = modal.querySelector('#editor-image-alt');
        const imageUrlInput = modal.querySelector('#editor-image-url');
        const imagePreview = modal.querySelector('#editor-image-preview');

        // Set modal title
        title.textContent = `Edit ${config.id.replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase())}`;

        // Show appropriate form based on content type
        if (config.type === 'image') {
            // Show image upload form
            singleFieldGroup.style.display = 'none';
            dualFieldGroup.style.display = 'none';
            imageFieldGroup.style.display = 'block';
            
            // Get current image data
            const imgElement = this.currentEditingElement.element.tagName === 'IMG' 
                ? this.currentEditingElement.element 
                : this.currentEditingElement.element.querySelector('img');
            
            if (imgElement) {
                const currentSrc = imgElement.getAttribute('src') || '';
                const currentAlt = imgElement.getAttribute('alt') || '';
                
                // Show current image preview
                imagePreview.src = currentSrc;
                imagePreview.style.display = 'block';
                
                // Populate fields
                imageAltInput.value = currentAlt;
                imageUrlInput.value = currentSrc;
            }
            
            // Set up file input change handler
            imageFileInput.onchange = (e) => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                        imageUrlInput.value = ''; // Clear URL input when file is selected
                    };
                    reader.readAsDataURL(file);
                }
            };
            
            // Focus on alt text input
            imageAltInput.focus();
        } else if (config.type === 'url' && !config.id.includes('hero-video')) {
            // Show dual field form for URL elements (except hero video)
            singleFieldGroup.style.display = 'none';
            dualFieldGroup.style.display = 'block';
            imageFieldGroup.style.display = 'none';
            
            // Get current text content (from span inside the link)
            const textSpan = this.currentEditingElement.element.querySelector('span[data-editor-id]');
            const currentText = textSpan ? textSpan.textContent : this.currentEditingElement.element.textContent;
            
            // Get current URL
            const currentUrl = this.currentEditingElement.element.getAttribute('href') || '';
            
            // Populate both fields
            textInput.value = currentText;
            urlInput.value = currentUrl;
            
            // Focus on text input
            textInput.focus();
        } else {
            // Show single field form for other content types
            singleFieldGroup.style.display = 'block';
            dualFieldGroup.style.display = 'none';
            imageFieldGroup.style.display = 'none';
            
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
            textarea.focus();
        }

        modal.classList.add('active');
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
        const textInput = this.modal.querySelector('#editor-text-content');
        const urlInput = this.modal.querySelector('#editor-url-content');
        const imageFileInput = this.modal.querySelector('#editor-image-file');
        const imageAltInput = this.modal.querySelector('#editor-image-alt');
        const imageUrlInput = this.modal.querySelector('#editor-image-url');

        // Determine which form is active and get content
        let content = '';
        let isDualField = false;
        let isImageField = false;
        
        if (imageFileInput && imageFileInput.style.display !== 'none') {
            // Image upload form is active
            isImageField = true;
            const imageFile = imageFileInput.files[0];
            const imageAlt = imageAltInput.value.trim();
            const imageUrl = imageUrlInput.value.trim();
            
            if (!imageAlt) {
                this.showMessage('Alt text is required', 'error');
                return;
            }
            
            content = { file: imageFile, alt: imageAlt, url: imageUrl };
        } else if (textInput && urlInput && textInput.style.display !== 'none') {
            // Dual field form is active
            isDualField = true;
            const textContent = textInput.value.trim();
            const urlContent = urlInput.value.trim();
            
            if (!textContent || !urlContent) {
                this.showMessage('Both text and URL fields are required', 'error');
                return;
            }
            
            content = { text: textContent, url: urlContent };
        } else {
            // Single field form is active
            content = textarea.value.trim();
            
            if (!content) {
                this.showMessage('Content cannot be empty', 'error');
                return;
            }
        }

        // Show loading state
        saveBtn.disabled = true;
        loading.style.display = 'inline-block';
        saveBtn.textContent = 'Saving...';

        try {
            if (isImageField) {
                // Handle image upload
                const config = this.currentEditingElement.config;
                
                // Create FormData for file upload
                const formData = new FormData();
                formData.append('elementId', config.id);
                formData.append('contentType', 'image');
                formData.append('alt', content.alt);
                
                if (content.file) {
                    // Upload file
                    formData.append('image', content.file);
                    const response = await this.uploadImage(formData);
                    
                    if (response.success) {
                        this.updateElementContent({ src: response.imageUrl, alt: content.alt });
                        this.showMessage('Image uploaded successfully!', 'success');
                        setTimeout(() => this.closeModal(), 1500);
                    } else {
                        this.showMessage(response.message || 'Failed to upload image', 'error');
                    }
                } else if (content.url) {
                    // Save URL directly
                    const response = await this.saveContent({
                        elementId: config.id,
                        contentType: 'image',
                        content: JSON.stringify({ src: content.url, alt: content.alt })
                    });
                    
                    if (response.success) {
                        this.updateElementContent({ src: content.url, alt: content.alt });
                        this.showMessage('Image URL saved successfully!', 'success');
                        setTimeout(() => this.closeModal(), 1500);
                    } else {
                        this.showMessage(response.message || 'Failed to save image URL', 'error');
                    }
                } else {
                    this.showMessage('Please select a file or enter an image URL', 'error');
                }
            } else if (isDualField) {
                // Handle dual field saving for URL elements
                const config = this.currentEditingElement.config;
                
                // Save text content
                const textResponse = await this.saveContent({
                    elementId: config.id.replace('-link', ''), // Remove '-link' suffix for text
                    contentType: 'text',
                    content: content.text
                });
                
                // Save URL content
                const urlResponse = await this.saveContent({
                    elementId: config.id,
                    contentType: 'url',
                    content: content.url
                });
                
                if (textResponse.success && urlResponse.success) {
                    this.updateElementContent(content);
                    this.showMessage('Content saved successfully!', 'success');
                    setTimeout(() => this.closeModal(), 1500);
                } else {
                    this.showMessage('Failed to save content', 'error');
                }
            } else {
                // Handle single field saving
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
        
        // Handle image content
        if (config.type === 'image') {
            const imgElement = element.tagName === 'IMG' 
                ? element 
                : element.querySelector('img');
            
            if (imgElement) {
                if (typeof content === 'object' && content.src) {
                    // Update image src and alt
                    imgElement.setAttribute('src', content.src);
                    if (content.alt) {
                        imgElement.setAttribute('alt', content.alt);
                    }
                } else {
                    // Handle JSON string content from database
                    try {
                        const imageData = JSON.parse(content);
                        imgElement.setAttribute('src', imageData.src);
                        if (imageData.alt) {
                            imgElement.setAttribute('alt', imageData.alt);
                        }
                    } catch (e) {
                        // Fallback to treating content as src
                        imgElement.setAttribute('src', content);
                    }
                }
            }
            return;
        }
        
        // Handle dual-field content (for URL elements)
        if (typeof content === 'object' && content.text && content.url) {
            // Update both text and URL
            const textSpan = element.querySelector('span[data-editor-id]');
            if (textSpan) {
                textSpan.textContent = content.text;
            }
            element.setAttribute('href', content.url);
            return;
        }
        
        // Handle single-field content
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

    async uploadImage(formData) {
        const response = await fetch(this.apiEndpoint, {
            method: 'POST',
            body: formData // FormData will set the correct Content-Type
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