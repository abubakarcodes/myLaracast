<template>
  <div>
    <!-- Modal -->
    <div
      class="modal fade mt-5"
      id="loginModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Login / Sign In</h4>
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
                        type="password"
                        class="form-control form-control-lg"
                        placeholder="Password"
                        v-model="password"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="col">
                        <input type="checkbox" class="form-control-checkbox" v-model="rememberMe" />
                        <label>
                          <h5>Remember Me</h5>
                        </label>
                        <div class="pull-right">
                            <h5><a :href="this.resetPassword">Forget Password?</a></h5>
                            <h5><a href="#" @click="showRegisterModal()" >Create Account</a></h5>
                        </div>

                      </div>
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
                      :disabled="!isValidLoginForm"
                      class="btn btn-success btn-lg w-100"
                      @click="attemptLogin()"
                    ><i class="fa fa-sign-in" aria-hidden="true"></i> Login</button>
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
      email: "",
      password: "",
      rememberMe: true,
      loading: false,
      resetPassword: '/password/reset',
    };
  },

  methods: {
    isValidateEmail: function() {
      if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) {
        return true;
      }
      return false;
    },

    attemptLogin: function() {
      this.loading = true;
      axios
        .post("/login", {
          email: this.email,
          password: this.password,
          remember: this.rememberMe
        })
        .then(res => {
          console.log(res);
          console.log(this.loading);

          Swal.fire({
            position: "top-end",
            icon: "success",
            title: res.data,
            showConfirmButton: false,
            timer: 1500,
            onClose: () => {
                $('#loginModal').modal('hide');
              location.reload();
            }
          });
        })
        .catch(err => {
          if (err.response.status == 422) {
            Swal.fire({
              position: "top-end",
              icon: "error",
              title: "Your credentails donot match.",
              showConfirmButton: false,
              timer: 1500
            });
          } else {
            Swal.fire({
              position: "top-end",
              icon: "error",
              title: "Something Went Wrong. Please Try Again!",
              showConfirmButton: false,
              timer: 1500
            });
          }
        })
        .finally(() => {
          this.loading = false;
          console.log(this.loading);
        });
    },
    showRegisterModal(){
        $('#loginModal').modal('hide');
        $('#registrationFormModal').modal('show');
    }
  },

  computed: {
    isValidLoginForm: function() {
      return this.isValidateEmail() && this.password;
    }
  }
};
</script>
