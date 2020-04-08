<template>
  <div class="post-wrapper p-4 my-4 bg-white">
    <div class="_wrap-form">
      <form action class="_bg-form">
        <div class="form-group">
          <input type="text" class="form-control" name="title" id="title" placeholder="Title" />
        </div>
        <div class="form-group">
          <textarea
            name="body"
            id="body"
            cols="30"
            rows="8"
            class="form-control"
            placeholder="Body"
          ></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
      </form>
    </div>
    <!-- <form role="form" action="#" method="POST">
      <div class="card card-outline card-info mb-4">
        <div class="card-body">
          <div class="col-lg-6 float-left">
            <div class="form-group">
              <label for="category">
                <em>Category</em>
              </label>
              <select class="custom-select" name="category">
                <option selected>-- Choose category --</option>
              </select>
            </div>
          </div>
          <div class="col-lg-6 float-right">
            <div class="form-group">
              <label for="slug">
                <em>Post slug</em>
              </label>
              <input type="text" class="form-control" id="slug" name="slug" placeholder="post-slug" />
            </div>
          </div>
          <div class="float-right">
            <button type="submit" id="submit" class="btn btn-primary btn-sm mr-3">Submit</button>
          </div>
        </div>
      </div>
      <div name="body" id="body"></div>
      <ckeditor :editor="editor" v-model="editorData" :config="editorConfig" class="ml-5"></ckeditor>
      <input type="hidden" id="bodyvalue" name="body" value />
    </form>-->
  </div>
</template>

<script>
    // import Vue from "vue";
    // import BalloonEditor from '@ckeditor/ckeditor5-build-balloon-block';
    // import CKEditor from '@ckeditor/ckeditor5-vue';

    // Vue.use( CKEditor );

    export default {
        name: 'Post',
        // components: {
        //     // Use the <ckeditor> component in this view.
        //     ckeditor: CKEditor.component
        // },
        // data() {
        //     return {
        //         editor: BalloonEditor,
        //         editorData: '<p>Content of the editor.</p>',
        //         editorConfig: {
        //             // The configuration of the editor.
        //         }
        //     };
        // }
    }
</script>