import Vue from 'vue';
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
Vue.use(VueToast);
/* ------------------------------ Success Toast ----------------------------------------*/
export const successToast = (message, position = "top-right") => {
    Vue.$toast.success(message, {
        position: position,
        duration: 7000,
        dismissible: true,
    });
}