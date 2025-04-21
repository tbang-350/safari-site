// Image source toggle
document.addEventListener('DOMContentLoaded', function() {
    // Image source toggle
    document.querySelectorAll('input[name="image_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.getElementById('custom-image-upload').style.display = this.value === 'custom' ? 'block' : 'none';
            document.getElementById('pexels-image-section').style.display = this.value === 'pexels' ? 'block' : 'none';

            // Clear the other input when switching
            if (this.value === 'custom') {
                document.getElementById('selected_image').value = '';
                document.getElementById('selected-pexels-preview').style.display = 'none';
            } else {
                document.getElementById('image').value = '';
            }
        });
    });

    // Remove selected Pexels image
    document.getElementById('remove-pexels-image')?.addEventListener('click', function() {
        document.getElementById('selected_image').value = '';
        document.getElementById('selected-pexels-preview').style.display = 'none';
        document.getElementById('selected-pexels-image').src = '';
    });

    // Pexels search
    document.getElementById('search-pexels')?.addEventListener('click', async function() {
        const query = document.getElementById('pexels_search').value;
        if (!query) {
            alert('Please enter a search term');
            return;
        }

        // Show loading state
        const resultsDiv = document.getElementById('pexels-results');
        resultsDiv.innerHTML = `
            <div class="col-12 text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `;

        try {
            const response = await fetch(`/dashboard/pexels/search?query=${encodeURIComponent(query)}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            resultsDiv.innerHTML = '';

            if (data.photos && data.photos.length > 0) {
                data.photos.forEach(photo => {
                    const col = document.createElement('div');
                    col.className = 'col-6 col-md-4 mb-3';
                    col.innerHTML = `
                        <div class="options-container">
                            <img class="img-fluid options-item" src="${photo.src.medium}" alt="${photo.alt || 'Tour image'}">
                            <div class="options-overlay bg-black-75">
                                <div class="options-overlay-content">
                                    <button type="button" class="btn btn-sm btn-primary select-pexels-image"
                                        data-image-url="${photo.src.large2x}"
                                        data-preview-url="${photo.src.medium}">
                                        <i class="fa fa-check me-1"></i> Select
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                    resultsDiv.appendChild(col);
                });

                // Add click handlers for image selection
                document.querySelectorAll('.select-pexels-image').forEach(button => {
                    button.addEventListener('click', function() {
                        const imageUrl = this.dataset.imageUrl;
                        const previewUrl = this.dataset.previewUrl;

                        // Set the selected image URL
                        document.getElementById('selected_image').value = imageUrl;

                        // Update preview
                        document.getElementById('selected-pexels-image').src = previewUrl;
                        document.getElementById('selected-pexels-preview').style.display = 'block';

                        // Close modal
                        bootstrap.Modal.getInstance(document.getElementById('modal-pexels-search')).hide();

                        // Visual feedback
                        document.querySelectorAll('.options-container').forEach(container => {
                            container.classList.remove('selected');
                        });
                        this.closest('.options-container').classList.add('selected');
                    });
                });
            } else {
                resultsDiv.innerHTML = `
                    <div class="col-12">
                        <div class="alert alert-warning">
                            No images found for "${query}". Try a different search term.
                        </div>
                    </div>
                `;
            }
        } catch (error) {
            console.error('Error:', error);
            resultsDiv.innerHTML = `
                <div class="col-12">
                    <div class="alert alert-danger">
                        Failed to fetch images. Please try again later.
                    </div>
                </div>
            `;
        }
    });

    // Form validation and submission
    document.getElementById('create-tour-form')?.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Clear previous errors
        document.querySelectorAll('.invalid-feedback').forEach(el => {
            el.style.display = 'none';
            el.textContent = '';
        });

        const formData = new FormData(this);

        // Validate image selection
        if (formData.get('image_type') === 'pexels' && !formData.get('image_source')) {
            alert('Please select an image from Pexels');
            return;
        }

        try {
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const data = await response.json();

            if (response.ok && data.success) {
                // Show success message if Dashmix notification helper is available
                if (typeof Dashmix !== 'undefined' && Dashmix.helpers) {
                    Dashmix.helpers('jq-notify', {
                        type: 'success',
                        icon: 'fa fa-check me-1',
                        message: data.message || 'Tour created successfully'
                    });
                }

                // Get the redirect URL from the form's data attribute
                const redirectUrl = this.dataset.redirectUrl;

                // Redirect after a short delay
                setTimeout(() => {
                    window.location.href = redirectUrl || '/dashboard/tours';
                }, 1500);
            } else {
                // Display validation errors
                if (data.errors) {
                    Object.keys(data.errors).forEach(key => {
                        const errorDiv = document.getElementById(`${key}-error`);
                        if (errorDiv) {
                            errorDiv.textContent = data.errors[key][0];
                            errorDiv.style.display = 'block';
                        }
                    });

                    // Scroll to the first error
                    const firstError = document.querySelector('.invalid-feedback[style="display: block"]');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                } else {
                    // Show error message
                    if (typeof Dashmix !== 'undefined' && Dashmix.helpers) {
                        Dashmix.helpers('jq-notify', {
                            type: 'danger',
                            icon: 'fa fa-times me-1',
                            message: 'An error occurred while saving the tour. Please try again.'
                        });
                    } else {
                        alert('An error occurred while saving the tour. Please try again.');
                    }
                }
            }
        } catch (error) {
            console.error('Error:', error);
            // Show error message
            if (typeof Dashmix !== 'undefined' && Dashmix.helpers) {
                Dashmix.helpers('jq-notify', {
                    type: 'danger',
                    icon: 'fa fa-times me-1',
                    message: 'An error occurred while saving the tour. Please try again.'
                });
            } else {
                alert('An error occurred while saving the tour. Please try again.');
            }
        }
    });

    // Delete tour functionality
    let tourToDelete = null;

    document.querySelectorAll('.delete-tour-btn').forEach(button => {
        button.addEventListener('click', function() {
            tourToDelete = this.dataset.tourId;
            const tourTitle = this.dataset.tourTitle;
            document.querySelector('#modal-delete-tour .block-content p').textContent =
                `Are you sure you want to delete the tour "${tourTitle}"? This action cannot be undone.`;
        });
    });

    document.getElementById('confirm-delete-tour')?.addEventListener('click', async function() {
        if (!tourToDelete) return;

        try {
            const response = await fetch(`/dashboard/tours/${tourToDelete}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const data = await response.json();

            if (data.success) {
                window.location.reload();
            } else {
                alert('Failed to delete the tour. Please try again.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while deleting the tour. Please try again.');
        }
    });
});
