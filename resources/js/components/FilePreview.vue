// FilePreview.vue
<script>
import { ref, watch, onBeforeUnmount } from 'vue';

export default {
  name: 'FilePreview',
  props: {
    file: {
      type: File,
      required: true
    }
  },
  setup(props) {
    const previewUrl = ref('');
    const showPreview = ref(false);
    const error = ref(false);

    const generatePreview = (file) => {
      if (!file) {
        previewUrl.value = '';
        showPreview.value = false;
        return;
      }

      // Check if file is PDF
      if (file.type === 'application/pdf') {
        previewUrl.value = URL.createObjectURL(file);
        showPreview.value = true;
        error.value = false;
      } else {
        error.value = true;
        showPreview.value = false;
      }
    };

    // Watch for file changes
    watch(() => props.file, (newFile) => {
      generatePreview(newFile);
    }, { immediate: true });

    // Cleanup object URL on component unmount
    onBeforeUnmount(() => {
      if (previewUrl.value) {
        URL.revokeObjectURL(previewUrl.value);
      }
    });

    return {
      previewUrl,
      showPreview,
      error
    };
  }
}
</script>

<template>
  <div class="pdf-preview">
    <div v-if="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
      File harus berformat PDF
    </div>
    
    <div v-if="showPreview" class="mt-4">
      <div class="border rounded-lg overflow-hidden">
        <iframe
          :src="previewUrl"
          class="w-full h-[600px]"
          type="application/pdf"
        ></iframe>
      </div>
    </div>
  </div>
</template>