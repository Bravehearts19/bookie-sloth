import Vue from "vue";
import VueRouter from "vue-router";

import Home from "./pages/Home.vue";
import Featured from "./pages/Featured.vue";
import Populars from "./pages/Populars.vue";
import AdvancedResearch from "./pages/AdvancedResearch.vue";
import Apartment from "./pages/Apartment.vue";
import SendMessage from "./pages/SendMessage.vue";
import MessageError from "./pages/MessageError.vue";
import Error404 from "./pages/Error404.vue";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
      {
        path: "/",
        name: "home",
        component: Home,
      },
      {
        path: "/featured",
        name: "featured",
        component: Featured,
      },
      {
        path: "/populars",
        name: "populars",
        component: Populars,
      },
      {
        path: "/advanced-research",
        name: "advanced-research",
        component: AdvancedResearch,
      },
      {
        path: "/apartment/:id",
        name: "apartment",
        component: Apartment,
      },
      {
        path: "/send-message",
        name: "send-message",
        component: SendMessage,
      },
      {
        path: "/message-error",
        name: "message-error",
        component: MessageError,
      },
      {
        path: "/message-error",
        name: "message-error",
        component: MessageError,
      },
      {
        path: "/*",
        name: "error-404",
        component: Error404,
      },
    ],
  });
  
  export default router;