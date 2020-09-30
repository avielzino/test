window.Vue = require("vue");
Vue.component("front-page", require("./component.vue").default);

var app = new Vue({
    el: "#bla",
    data: {
        message: "Hello Vue!"
    }
});
