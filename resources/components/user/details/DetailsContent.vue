<template>
  <div class="single-product section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="left-image" v-for="image in product.images">
            <img :src="'http://[::1]:5173/resources/images/' + image.name" alt="">
          </div>
        </div>
        <div class="col-lg-6 align-self-center">
          <h4 class="text-light">{{ product.name }}</h4>
          <span class="price"><em>{{ product.price }}</em> {{ product.discount }}</span>
          <p class="text-light">{{ product.description }}</p>
          <div v-if="paymentStatus===0" @click="addToCart" class="btn btn-danger my-3" type="submit"> ADD TO CART</div>
          <div v-else class="btn btn-primary my-3" type="submit">INSTALL</div>
          <div class="text-danger">{{ message }}</div>
          <br>
          <div class="like" v-bind:class="{ 'text-danger': liked === 1 }" @click="sendLike"
            style="font-size: 3em; display: inline-block;">♡ </div>
          <span v-if="likeStatus === 0" class="count-like text-light" style="font-size: 1.5em;">{{ product.like
            }}</span>
          <span v-else class="count-like text-light" style="font-size: 1.5em;">{{ likeStatus }}</span>
        </div>
        <div class="col-lg-12" v-for="image in product.images">
          <div class="sep">
            <img class="move-up" :src="'http://[::1]:5173/resources/images/' + image.name" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="more-info">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="tabs-content">
            <div class="row">
              <div class="nav-wrapper ">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                      data-bs-target="#description" type="button" role="tab" aria-controls="description"
                      aria-selected="true">Description</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                      type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews (3)</button>
                  </li>
                </ul>
              </div>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel"
                  aria-labelledby="description-tab">
                  <p>{{ product.description }}</p>
                </div>
                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                  <p>Coloring book air plant shabby chic, crucifix normcore raclette cred swag artisan activated
                    charcoal. PBR&B fanny pack pok pok gentrify truffaut kitsch helvetica jean shorts edison bulb
                    poutine next level humblebrag la croix adaptogen. <br><br>Hashtag poke literally locavore, beard
                    marfa kogi bruh artisan succulents seitan tonx waistcoat chambray taxidermy. Same cred meggings 3
                    wolf moon lomo irony cray hell of bitters asymmetrical gluten-free art party raw denim chillwave
                    tousled try-hard succulents street art.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</template>
<script>
export default {
  data() {
    return {
      productId: null,
      product: [],
      likeStatus: 0,
      liked: 0,
      message: null,
      paymentStatus:0
    };
  },
  created() {
    this.productId = this.$route.params.id;
  },
  async mounted() {
    try {
      let id = this.productId;
      const response = await fetch(`http://localhost:8000/api/get-product-details/${id}`);
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      this.product = await response.json();
      this.getStatusLike();
      this.getStatusOfPayment();
    } catch (error) {
      console.error(error);
    }
  },
  methods: {
    async sendLike() {
      try {
        let user_id = JSON.parse(localStorage.getItem('id'));
        const response = await axios.post('http://localhost:8000/api/like', {
          user_id: user_id,
          product_id: this.product.id,
        });
        this.likeStatus = response.data;
        this.product.like = this.likeStatus;
        this.getStatusLike();
        const element = document.querySelector('.count-like');
        const delay = Math.random() * 5;
        element.style.animationDelay = `${delay}s`;
      } catch (error) {
        console.error(error);
      }
    },
    async getStatusLike() {
      try {
        let user_id = JSON.parse(localStorage.getItem('id'));
        const response = await axios.post('http://localhost:8000/api/like-status', {
          user_id: user_id,
          product_id: this.product.id,
        });
        this.liked = response.data;
      } catch (error) {
        console.error(error);
      }
    },
    async addToCart() {
      try {
        let user_id = JSON.parse(localStorage.getItem('id'));
        const response = await axios.post('http://localhost:8000/api/add-to-cart', {
          user_id: user_id,
          product_id: this.product.id,
        });
        if (response.data === 0) {
          this.message = 'This product is already in your cart!';
          if (this.message !== null) {
            setTimeout(() => {
              this.message = null;
            }, 5000); 
          }
          } else {
            const moveup = document.querySelector('.move-up');
            moveup.style.opacity = '1';
            moveup.style.transition = '1s ease-out';
            moveup.style.top = '-20%';
          }
        } catch (error) {
          console.error(error);
        }
      },
      async getStatusOfPayment() {
        try {
          let user_id = JSON.parse(localStorage.getItem('id'));
          const response = await axios.post('http://localhost:8000/api/get-payment-status', {
            user_id: user_id,
            product_id: this.product.id,
          });
        this.paymentStatus = response.data;
          } catch (error) {
            console.error(error);
          }
        },
    },
  };
</script>
<style scoped>
.count-like {
  position: absolute;
  animation: visible 1s cubic-bezier(0.6, -0.28, 0.735, 0.045) both;
}

.like {
  transition: 1s cubic-bezier(0.6, -0.28, 0.735, 0.045);
}

.like:hover {
  animation: scale 1s infinite ease-out alternate;
}

.move-up {
  position: absolute;
  width: 100px;
  top: 85%;
  left: 50%;
  opacity: 0;
}

@keyframes visible {
  0% {
    opacity: 0;
    transform: rotate(0deg);
  }

  100% {
    opacity: 1;
    transform: rotate(1800deg);
  }
}

@keyframes scale {
  0% {
    opacity: 1;
    transform: scale(1);
  }

  100% {
    opacity: 0.5;
    transform: scale(3);
  }
}
</style>