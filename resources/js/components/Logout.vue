<template>
  <div>
    <a
      class="dropdown-item"
      href="#"
      @click="logout()"
    ><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
  </div>
</template>
<script>
import Swal from "sweetalert2";
export default {
    methods:{
        logout(){
            axios.post('/logout')
            .then(res => {
                console.log(res);
                Swal.fire({
            position: "top-end",
            icon: "success",
            title: "You have successfully Logout",
            showConfirmButton: false,
            timer: 1500,
            onClose: () => {
              location.reload();
            }
          });
            })
            .catch(err => {
                console.error(err);
            })
        }
    }
};
</script>
