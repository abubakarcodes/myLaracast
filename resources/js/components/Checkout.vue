<template>
  <div>
    <!-- Button trigger modal -->
    <button
      @click="openModal('monthly')"
      class="btn btn-danger btn-lg"
    >Subscribe for only $9.99 Monthly</button>
    <button
      @click="openModal('yearly')"
      class="btn btn-primary btn-lg"
    >Subscribe for only $99.99 Yearly</button>
    <!-- Modal -->
    <div
      class="modal fade"
      id="modelId"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modelTitleId"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Payment for {{this.plan}} Plan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <input
                class="form-control"
                v-model="name"
                placeholder="Card Holder Name"
                id="card-holder-name"
                type="text"
              />
            </div>
            <!-- Stripe Elements Placeholder -->
            <div class="form-group">
              <div class="form-control" id="card-element"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <div
              v-if="loading"
              class="spinner-border text-primary"
              role="status"
            >
              <span class="sr-only">Loading...</span>
            </div>
            <button
              v-if="!loading"
              type="button"
              id="card-button"
              class="btn btn-primary"
            >${{this.amount}} Process Payment</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Swal from "sweetalert2";
export default {
  props: ["default_stripe_public_key"],
  data() {
    return {
      amount: null,
      plan: "",
      name: "",
      product: "",
      loading: false
    };
  },
  mounted() {
    const stripe = Stripe(this.default_stripe_public_key);

    const elements = stripe.elements();
    const cardElement = elements.create("card");

    cardElement.mount("#card-element");
    const cardHolderName = document.getElementById("card-holder-name");
    const cardButton = document.getElementById("card-button");
    cardButton.addEventListener("click", async e => {
      this.loading = true;
      const { paymentMethod, error } = await stripe.createPaymentMethod(
        "card",
        cardElement,
        {
          billing_details: { name: this.name }
        }
      );

      if (error) {
        this.loading = false;
      } else {
        console.log(paymentMethod);
        axios
          .post("/checkout", {
            plan: this.plan,
            product: this.product,
            paymentM: paymentMethod.id
          })
          .then(res => {
            console.log(res);
            Swal.fire({
            position: "center",
            icon: "success",
            title: "You have successfully Subscribed To Premium Series",
            showConfirmButton: false,
            timer: 1500,
          });
          })
          .catch(err => {
            console.error(err);
          })
          .finally(() => {
            this.loading = false;
            $("#modelId").modal("hide");
            location.reload();
          });
      }
    });
  },
  methods: {
    openModal(plan) {
      if (plan === "monthly") {
        this.amount = 9.99;
        this.plan = "monthly";
        this.product = "price_HHscK4hA3OppYy";
        $("#modelId").modal("show");
      } else if (plan === "yearly") {
        this.amount = 99.99;
        this.plan = "yearly";
        this.product = "price_HHseeeuTgOe3DY";
        $("#modelId").modal("show");
      }
    }
  }
};
</script>
