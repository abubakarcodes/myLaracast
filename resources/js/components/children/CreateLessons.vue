<template>
  <div>
    <!-- Modal -->
    <div
      class="modal fade mt-5"
      id="createLesson"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Create Lessons</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <form action="#">
                <div class="row justify-content-center">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control form-control-lg"
                        placeholder="Title"
                        v-model="title"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control form-control-lg"
                        placeholder="vemeo video Id"
                        v-model="video_id"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input
                        type="number"
                        class="form-control form-control-lg"
                        placeholder="Episode Number"
                        v-model="episodeNumber"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <textarea
                        placeholder="Description"
                        v-model="description"
                        class="form-control form-control-lg"
                      ></textarea>
                    </div>
                  </div>
                  <div v-if="loading" class="col-md-12 d-flex justify-content-center">
                    <div
                      class="spinner-border text-success"
                      style="width: 3rem; height: 3rem;"
                      role="status"
                    >
                      <span class="sr-only">Loading...</span>
                    </div>
                  </div>
                  <div v-if="!loading" class="col-md-12">
                    <button
                      v-if="!editing"
                      :disabled="!isValidateForm"
                      @click="store()"
                      type="button"
                      class="btn btn-success btn-lg w-100"
                    >Create New Lesson</button>
                    <button
                      :disabled="!isValidateForm"
                      v-if="editing"
                      @click="update()"
                      type="button"
                      class="btn btn-success btn-lg w-100"
                    >Update Lesson</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Swal from "sweetalert2";
export default {
  mounted() {
    this.$parent.$on("create_new_lesson", series_id => {
      this.editing = false;
      this.title = "";
      this.description = "";
      this.episodeNumber = "";
      this.video_id = "";
      this.series_id = series_id;
      $("#createLesson").modal("show");
    });
    this.$parent.$on("edit_lesson", ({ series_id, lesson }) => {
      this.editing = true;
      $("#createLesson").modal("show");
      this.series_id = series_id;
      this.title = lesson.title;
      this.description = lesson.description;
      this.episodeNumber = lesson.episode_number;
      this.video_id = lesson.video_id;
      this.lessonId = lesson.id;
    });
  },

  data() {
    return {
      loading: false,
      title: "",
      description: "",
      episodeNumber: "",
      video_id: "",
      series_id: "",
      errors: [],
      editing: false,
      lessonId: null
    };
  },
  computed: {
    isValidateForm() {
      return (
        this.title && this.description && this.episodeNumber && this.video_id
      );
    }
  },
  methods: {
    store() {
      this.loading = true;
      axios
        .post("/admin/series/" + this.series_id + "/lessons", {
          title: this.title,
          description: this.description,
          episode_number: this.episodeNumber,
          video_id: this.video_id
        })
        .then(res => {
          console.log(res);
          this.title = "";
          this.description = "";
          this.episodeNumber = "";
          this.video_id = "";
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "You have successfully Saved Changes",
            showConfirmButton: false,
            timer: 800
          });
          this.$parent.$emit("lesson_created", res.data);
        })
        .catch(err => {
          console.log(err.response);
          if (err.response.status == 422) {
            this.errors.push(err.response.data);
          } else {
            Swal.fire({
              position: "top-end",
              icon: "error",
              title: "Something went wrong. Please Try Again!",
              showConfirmButton: false,
              timer: 800,
              onClose: () => {
                location.reload();
              }
            });
          }
        })
        .finally(() => {
          this.loading = false;
        });
    },

    update() {
      this.loading = true;
      axios
        .put("/admin/series/" + this.series_id + "/lessons/" + this.lessonId, {
          title: this.title,
          description: this.description,
          episode_number: this.episodeNumber,
          video_id: this.video_id
        })
        .then(res => {
          console.log(res);
          this.title = "";
          this.description = "";
          this.episodeNumber = "";
          this.video_id = "";
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "You have successfully Saved Changes",
            showConfirmButton: false,
            timer: 800
          });
          $("#createLesson").modal("close");
          this.$parent.$emit("lesson_updated", res.data);
        })
        .catch(err => {
          console.log(err.response);
          if (err.response.status == 422) {
            this.errors.push(err.response.data);
          } else {
            Swal.fire({
              position: "top-end",
              icon: "error",
              title: "Something went wrong. Please Try Again!",
              showConfirmButton: false,
              timer: 800,
              onClose: () => {
                location.reload();
              }
            });
          }
        })
        .finally(() => {
          this.loading = false;
          this.editing = false;
        });
    }
  }
};
</script>
