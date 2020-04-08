<template>
  <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
</template>

<script>
    import Vue from "vue";
    import BalloonEditor from '@ckeditor/ckeditor5-build-balloon-block';
    import CKEditor from '@ckeditor/ckeditor5-vue';

    Vue.use( CKEditor );

    export default {
        name: 'Post',
        components: {
            // Use the <ckeditor> component in this view.
            ckeditor: CKEditor.component
        },
        data() {
            return {
                editor: BalloonEditor,
                editorData: '<p>Content of the editor.</p>',
                editorConfig: {
                    // The configuration of the editor.
                }
            };
        }
    }
</script>