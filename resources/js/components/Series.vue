<template>
  <div>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="card">
            <div class="card-header">
              <h5>Create Series Form</h5>
            </div>
            <form @submit="store" id="createForm" enctype="multipart/form-data">
              <div class="card-body">
                <ul class="alert alert-danger" v-if="createForm.errors.length > 0">
                  <div>Opps! Something Went Wrong!</div>
                  <li
                    class="ml-3"
                    v-for="error in createForm.errors"
                    :key="createForm.errors.indexOf(error)"
                  >{{error.imageUrl[0]}}</li>
                </ul>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control form-control-lg"
                        v-model="createForm.title"
                        placeholder="Enter Title"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input
                        type="file"
                        id="imageUrl"
                        class="form-control form-control-lg"
                        placeholder="Enter Image Url"
                        v-on:change="handleCreateFileChange"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <textarea
                        type="text"
                        class="form-control form-control-lg"
                        v-model="createForm.description"
                        placeholder="Enter Description"
                      />
                    </div>
                  </div>
                </div>
                <div v-if="createForm.loading" class="col-md-12 d-flex justify-content-center">
                  <div
                    class="spinner-border text-success"
                    style="width: 3rem; height: 3rem;"
                    role="status"
                  >
                    <span class="sr-only">Loading...</span>
                  </div>
                </div>
                <button
                  v-if="!createForm.loading"
                  type="submit"
                  :disabled="!isValidateCreateForm"
                  class="btn btn-success btn-lg w-100"
                >
                  <i class="fa fa-plus" aria-hidden="true"></i> Save
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!--Edit Modal -->
      <div
        class="modal fade"
        id="editModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="modelTitleId"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Series Form</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form
              id="editForm"
              action="#"
              enctype="multipart/form-data"
              @submit="update(editForm.id)"
            >
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <ul class="alert alert-danger" v-if="editForm.errors.length > 0">
                      <div>Opps! Something Went Wrong!</div>
                      <li
                        class="ml-3"
                        v-for="error in editForm.errors"
                        :key="editForm.errors.indexOf(error)"
                      >{{error.imageUrl[0]}}</li>
                    </ul>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control form-control-lg"
                        v-model="editForm.title"
                        placeholder="Enter Title"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input
                        type="file"
                        class="form-control form-control-lg"
                        v-on:change="handleEditFileChange"
                        placeholder="Enter Image Url"
                        id="editImageUrl"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <textarea
                        type="text"
                        class="form-control form-control-lg"
                        v-model="editForm.description"
                        placeholder="Enter Description"
                      />
                    </div>
                  </div>
                </div>
                <div v-if="editForm.loading" class="col-md-12 d-flex justify-content-center">
                  <div
                    class="spinner-border text-success"
                    style="width: 3rem; height: 3rem;"
                    role="status"
                  >
                    <span class="sr-only">Loading...</span>
                  </div>
                </div>
                <button
                  v-if="!editForm.loading"
                  type="submit"
                  :disabled="!isValidateEditForm"
                  class="btn btn-success btn-lg w-100"
                >
                  <i class="fa fa-refresh" aria-hidden="true"></i> Save Changes
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <br />
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5>Items Listings</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <td>Id</td>
                      <td>Title</td>
                      <td>Description</td>
                      <td>ImageUrl</td>
                      <td>Actions</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="item in this.data" :key="item.id">
                      <td>{{item.id }}</td>
                      <td>{{item.title | truncate(20)}}</td>
                      <td>{{item.description | truncate(50)}}</td>
                      <td>
                        <img :src="'/series/' + item.imageUrl" alt style="width:80px; height:50px" />
                      </td>
                      <td>
                        <a class="btn btn-outline-dark" :href="'/admin/series/' + item.slug" > <i class="fa fa-eye" aria-hidden="true"></i></a>
                        <button @click="edit(item)" class="btn btn-outline-primary">
                          <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                        <button class="btn btn-outline-danger" @click="destroy(item)">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
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
  data() {
    return {
      data: [],
      createForm: {
        title: "",
        description: "",
        imageUrl: "",
        errors: [],
        loading: false
      },
      editForm: {
        errors: [],
        id: "",
        title: "",
        description: "",
        imageUrl: "",
        loading: false
      }
    };
  },

  mounted() {
    this.getData();
  },
  filters: {
    truncate: function(value, limit) {
      if (value.length > limit) {
        value = value.substring(0, limit - 3) + "...";
      }

      return value;
    }
  },
  computed: {
    isValidateCreateForm() {
      return this.persistFormValidation(this.createForm);
    },
    isValidateEditForm() {
      return this.persistFormValidation(this.editForm);
    }
  },

  methods: {
    getData() {
      axios
        .get("/admin/series")
        .then(res => {
          //   console.log(res.data);
          this.data = res.data;
        })
        .catch(err => {
          console.error(err);
        });
    },
    persistFormValidation(form) {
      return form.title && form.imageUrl && form.description;
    },
    handleCreateFileChange(e) {
      console.log(e.target.files[0]);
      this.createForm.imageUrl = e.target.files[0];
    },
    handleEditFileChange(e) {
      this.editForm.imageUrl = e.target.files[0];
    },

    //store method
    store(e) {
      e.preventDefault();
      this.createForm.loading = true;
      let formData = new FormData();
      formData.append("imageUrl", this.createForm.imageUrl);
      formData.append("title", this.createForm.title);
      formData.append("description", this.createForm.description);
      axios
        .post("/admin/series", formData, {
          header: {
            "content-type": "multipart/form-data"
          }
        })
        .then(res => {
          //   console.log(res);
        //   this.data.splice(0, 0, res.data);
          this.getData();
          this.createForm.title = "";
          this.createForm.description = "";
          this.createForm.imageUrl = "";
          document.getElementById("imageUrl").value = null;
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "You have successfully Added",
            showConfirmButton: false,
            timer: 800
          });
        })
        .catch(err => {
          console.log(err.response);
          if (err.response.status == 422) {
            this.createForm.errors.push(err.response.data);
          } else {
            Swal.fire({
              position: "top-end",
              icon: "error",
              title: "Opps! Something Went Wrong. Please Try Again!",
              showConfirmButton: false,
              timer: 800
            });
          }
        })
        .finally(() => {
          this.createForm.loading = false;
        });
    },

    edit(item) {
      axios
        .get("/admin/series/" + item.id + "/edit")
        .then(res => {
          $("#editModal").modal("show");
          this.editForm.id = res.data.id;
          this.editForm.title = res.data.title;
          this.editForm.imageUrl = res.data.imageUrl;
          this.editForm.description = res.data.description;
        })
        .catch(err => {
          console.error(err);
        });
    },

    update(id) {
      document
        .getElementById("editForm")
        .addEventListener("submit", function(event) {
          event.preventDefault();
        });
      this.editForm.loading = true;
      let formData = new FormData();
      formData.append("_method", "put");
      formData.append("imageUrl", this.editForm.imageUrl);
      formData.append("title", this.editForm.title);
      formData.append("description", this.editForm.description);
      axios
        .post("/admin/series/" + id, formData, {
          header: {
            "content-type": "multipart/form-data"
          }
        })
        .then(res => {
          console.log(res);
          this.getData();
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "You have successfully Saved Changes",
            showConfirmButton: false,
            timer: 800
          });
        })
        .catch(err => {
          console.error(err.response);
          if (err.response.status == 422) {
            this.editForm.errors.push(err.response.data);
          } else {
            Swal.fire({
              position: "top-end",
              icon: "error",
              title: "Opps! Something went wrong. Please Try Again!",
              showConfirmButton: false,
              timer: 800,
              onClose: function(){
                  location.reload();
              }
            });
          }
        })
        .finally(() => {
          this.editForm.loading = false;
        });
    },

    //delete method
    destroy(item) {
      axios
        .delete("/admin/series/" + item.id)
        .then(res => {
          this.getData();
        //   this.data.splice(this.data.indexOf(item), 1);
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "You have successfully Deleted",
            showConfirmButton: false,
            timer: 800
          });
        })
        .catch(res => {
          Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Something went wrong. Please Try Again!",
            showConfirmButton: false,
            timer: 800
          });
        });
    }
  }
};
</script>
