<template>
  <div>
    <div
      class="modal fade mt-5"
      id="registrationFormModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Registeration Form</h4>
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
                        placeholder="Name"
                        v-model="name"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input
                        type="email"
                        class="form-control form-control-lg"
                        placeholder="Email"
                        v-model="email"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control form-control-lg"
                        placeholder="Username"
                        v-model="username"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input
                        type="password"
                        class="form-control form-control-lg"
                        placeholder="Password"
                        v-model="password"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input
                        type="password"
                        class="form-control form-control-lg"
                        placeholder="Confirm Password"
                        v-model="password_confirmation"
                      />
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
                      type="button"
                      :disabled="!isValidRegistrationForm"
                      class="btn btn-success btn-lg w-100"
                      @click="register()"
                    >Register</button>
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
  data() {
    return {
      name: "",
      email: "",
      username: "",
      password: "",
      password_confirmation: "",
      loading: false,
    };
  },
  methods: {
    isValidateEmail: function() {
      if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) {
        return true;
      }
      return false;
    },

    isPasswordMatch() {
      if (this.password === this.password_confirmation) {
        return true;
      } else {
        return false;
      }
    },

    register() {
      this.loading = true;
      axios
        .post("/register", {
          name: this.name,
          email: this.email,
          username: this.username,
          password: this.password,
          password_confirmation: this.password_confirmation
        })
        .then((res) => {
        //   console.log(res);
        //   console.log(this.loading);
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "You have successfully registered",
            showConfirmButton: false,
            timer: 1500,
            onClose: () => {
              location.reload();
            }
          });
        })
        .catch((err) => {
          if (err.response.status == 422) {
            if (err.response.data.email) {
              Swal.fire({
                position: "top-end",
                icon: "error",
                title: err.response.data.email[0],
                showConfirmButton: false,
                timer: 1500
              });
            }
            if (err.response.data.username) {
              Swal.fire({
                position: "top-end",
                icon: "error",
                title: err.response.data.username[0],
                showConfirmButton: false,
                timer: 1500
              });
            }
            if (err.response.data.password) {
              Swal.fire({
                position: "top-end",
                icon: "error",
                title: err.response.data.password[0],
                showConfirmButton: false,
                timer: 1500
              });
            }
            if (err.response.data.name) {
              Swal.fire({
                position: "top-end",
                icon: "error",
                title: err.response.data.name[0],
                showConfirmButton: false,
                timer: 1500
              });
            }
          } else if(err.response.status == 500) {
            Swal.fire({
              position: "top-end",
              icon: "error",
              title: "Internal Server Error. Try Again!",
              showConfirmButton: false,
              timer: 1500,
               onClose: () => {
              location.reload();
            }
            });
          }
        })
        .finally(() => {
          this.loading = false;
        //   console.log(this.loading);
        });
    }
  },

  computed: {
    isValidRegistrationForm: function() {
      return (
        this.name &&
        this.username &&
        this.isValidateEmail() &&
        this.password &&
        this.isPasswordMatch()
      );
    }
  }
};





</script>
