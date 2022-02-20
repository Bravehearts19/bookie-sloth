<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h2 class="text-white">Risultati: {{ hotelArray.length }}</h2>
        <div class="card-container">
          <div id="map-div"></div>
          <div
            class="apartment-card py-5 border-top border-bottom border-primary"
            :key="'hotel-' + index"
            v-for="(hotel, index) in hotelArray"
          >
            <h3 class="text-white">{{ hotel.name }}</h3>
            <h4 class="text-white">
              {{ hotel.address }} - {{ hotel.location }} - {{ hotel.cap }}
            </h4>
            <img :src="hotel.cover_img" :alt="hotel.name" class="w-50 py-3" />
            <h6 class="text-white">
              price: <span class="text-primary">{{ hotel.price }}</span>
            </h6>
            <h6 class="text-white">bathrooms: {{ hotel.n_bathrooms }}</h6>
            <h6 class="text-white">guests: {{ hotel.n_guests }}</h6>
            <h6 class="text-white">rooms: {{ hotel.n_rooms }}</h6>
            <h6 class="text-white">sizes: {{ hotel.size }} mq</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Home",
  data() {
    return {
      initialHotelArray: [],
      hotelArray: [],
      searchCoordinates: {
        x: "",
        y: "",
      },
    };
  },
  components: {},

  props: {
    searched: "",
    boolStartSearch: Boolean,
  },

  methods: {
    getAllHotelData() {
      window.axios
        .get("api/hotel/index", {
          params: {
            query: this.searched.toSearch,
          },
        })
        .then((resp) => {
          const data = resp.data;
          this.hotelArray = data;
          this.initialHotelArray = data;
        });
    },

    searchLocation(hotel) {
      // return hotel.x_coordinate
      //   .toString()
      //   .slice(0, 5)
      //   .includes(this.searchCoordinates.x.toString().slice(0, 5));
    },

    searchedHotel() {
      window.axios
        .get(
          "/api/search/filters?locationName=" +
            this.searched.toSearch +
            "&radius=" +
            this.searched.knobValue + 
            '&rooms=' +
            this.searched.roomsValue +
            '&bed=' +
            this.searched.bedValue 

        )
        .then((resp) => {
          this.hotelArray = resp.data;
        });

      //   this.hotelArray.forEach((hotel) => {
      //     const poiExample = {
      //       poi: {
      //         name: hotel.name,
      //       },
      //       address: {
      //         freeformAddress: hotel.address,
      //       },
      //       position: {
      //         lat: hotel.y_coordinate,
      //         lon: hotel.x_coordinate,
      //       },
      //     };
      //     this.pointsOfInterest.push(JSON.stringify(poiExample));
      //   });
    },
  },
  mounted() {
    this.getAllHotelData();
    const GOLDEN_GATE_BRIDGE = { lng: -122.47483, lat: 37.80776 };

    const API_KEY = "onx0t6tyRKJCe8Q2JIAWTMwu3Opxi7wH";
    const APPLICATION_NAME = "bookie_sloth";
    const APPLICATION_VERSION = "1.0";

    tt.setProductInfo(APPLICATION_NAME, APPLICATION_VERSION);
    var map = tt.map({
      key: API_KEY,
      container: "map-div",
      center: GOLDEN_GATE_BRIDGE,
      zoom: 12,
    });
  },

  computed: {
    boolSearch() {
      return this.boolStartSearch;
    },

    startSearchHotel() {
      if (!this.boolSearch) {
        if (this.searched.toSearch === "") {
          this.hotelArray = this.initialHotelArray;
        } else {
          this.searchedHotel();
        }
      }
    },
  },
};
</script>

<style lang="scss" scoped>
#map-div {
  height: 400px;
  width: 400px;
}
</style>
