<template>
  <div class="image-selector">
    <!-- Image Type Selection -->
    <div class="mb-4">
      <label class="form-label d-block">Image Source</label>
      <div class="space-x-2">
        <button
          type="button"
          class="btn"
          :class="imageType === 'pexels' ? 'btn-primary' : 'btn-alt-secondary'"
          @click="setImageType('pexels')"
        >
          Pexels Images
        </button>
        <button
          type="button"
          class="btn"
          :class="imageType === 'custom' ? 'btn-primary' : 'btn-alt-secondary'"
          @click="setImageType('custom')"
        >
          Custom Upload
        </button>
      </div>
    </div>

    <!-- Pexels Image Search -->
    <div v-if="imageType === 'pexels'" class="mb-4">
      <div class="input-group mb-3">
        <input
          type="text"
          class="form-control"
          v-model="searchQuery"
          placeholder="Search Pexels images..."
          @keyup.enter="searchPexels"
        >
        <button class="btn btn-alt-primary" type="button" @click="searchPexels">
          <i class="fa fa-search"></i>
        </button>
      </div>

      <!-- Loading State -->
      <div v-if="loading" class="text-center py-4">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>

      <!-- Image Grid -->
      <div v-else class="row g-3">
        <div v-for="photo in photos" :key="photo.id" class="col-md-4">
          <div
            class="image-card position-relative"
            :class="{ 'selected': selectedImage && selectedImage.id === photo.id }"
            @click="selectPexelsImage(photo)"
          >
            <img :src="photo.src.medium" class="img-fluid rounded" :alt="photo.alt">
            <div class="photographer-credit">
              Photo by {{ photo.photographer }}
            </div>
          </div>
        </div>
      </div>

      <!-- Pagination -->
      <div v-if="photos.length" class="d-flex justify-content-center mt-4">
        <button
          class="btn btn-alt-secondary me-2"
          :disabled="currentPage === 1"
          @click="changePage(currentPage - 1)"
        >
          Previous
        </button>
        <button
          class="btn btn-alt-secondary"
          :disabled="!hasMorePages"
          @click="changePage(currentPage + 1)"
        >
          Next
        </button>
      </div>
    </div>

    <!-- Custom Image Upload -->
    <div v-else class="mb-4">
      <input
        type="file"
        class="form-control"
        accept="image/*"
        @change="handleCustomUpload"
        ref="fileInput"
      >
      <div v-if="customImagePreview" class="mt-3">
        <img :src="customImagePreview" class="img-fluid rounded" style="max-height: 200px">
      </div>
    </div>

    <!-- Selected Image Preview -->
    <div v-if="modelValue" class="mt-4">
      <h4 class="fs-sm fw-semibold mb-2">Selected Image</h4>
      <div class="selected-image-preview">
        <img
          :src="previewUrl"
          class="img-fluid rounded"
          style="max-height: 200px"
        >
        <button
          type="button"
          class="btn btn-sm btn-danger mt-2"
          @click="clearSelection"
        >
          Remove Image
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ImageSelector',

  props: {
    modelValue: {
      type: Object,
      default: null
    }
  },

  data() {
    return {
      imageType: 'pexels',
      searchQuery: '',
      loading: false,
      photos: [],
      currentPage: 1,
      totalResults: 0,
      selectedImage: null,
      customImagePreview: null
    }
  },

  computed: {
    hasMorePages() {
      return this.photos.length * this.currentPage < this.totalResults
    },

    previewUrl() {
      if (!this.modelValue) return null
      return this.modelValue.type === 'pexels'
        ? this.modelValue.url
        : this.modelValue.preview
    }
  },

  methods: {
    setImageType(type) {
      this.imageType = type
      this.clearSelection()
    },

    async searchPexels() {
      if (!this.searchQuery.trim()) return

      this.loading = true
      try {
        const response = await fetch(`/dashboard/pexels/search?query=${encodeURIComponent(this.searchQuery)}&page=${this.currentPage}`)
        const data = await response.json()

        this.photos = data.photos
        this.totalResults = data.total_results
      } catch (error) {
        console.error('Error fetching Pexels images:', error)
      } finally {
        this.loading = false
      }
    },

    selectPexelsImage(photo) {
      this.selectedImage = photo
      this.$emit('update:modelValue', {
        type: 'pexels',
        id: photo.id,
        url: photo.src.large,
        photographer: photo.photographer
      })
    },

    handleCustomUpload(event) {
      const file = event.target.files[0]
      if (!file) return

      // Create preview
      const reader = new FileReader()
      reader.onload = (e) => {
        this.customImagePreview = e.target.result
        this.$emit('update:modelValue', {
          type: 'custom',
          file: file,
          preview: e.target.result
        })
      }
      reader.readAsDataURL(file)
    },

    clearSelection() {
      this.selectedImage = null
      this.customImagePreview = null
      this.$emit('update:modelValue', null)
      if (this.$refs.fileInput) {
        this.$refs.fileInput.value = ''
      }
    },

    changePage(page) {
      this.currentPage = page
      this.searchPexels()
    }
  },

  mounted() {
    // Load curated photos initially
    fetch('/dashboard/pexels/curated')
      .then(response => response.json())
      .then(data => {
        this.photos = data.photos
        this.totalResults = data.total_results
      })
      .catch(error => console.error('Error fetching curated photos:', error))
  }
}
</script>

<style scoped>
.image-card {
  cursor: pointer;
  transition: all 0.2s ease;
}

.image-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
}

.image-card.selected {
  border: 3px solid #5c80d1;
}

.photographer-credit {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0,0,0,0.7);
  color: white;
  padding: 0.25rem;
  font-size: 0.75rem;
  text-align: center;
}

.space-x-2 > * + * {
  margin-left: 0.5rem;
}
</style>
