import Vue from "vue";
const EventBus = new Vue();
export default EventBus;

axios.interceptors.request.use(
    function(req) {
        const method = req.method;
        if (method === "post" || method === "put" || method === "delete")
            EventBus.$emit("before-request");
        return req;
    },
    err => {
        EventBus.$emit("request-error");
        return Promise.reject(err);
    }
);

axios.interceptors.response.use(
    response => {
        EventBus.$emit("after-response");
        return response;
    },
    error => {
        EventBus.$emit("response-error");
        return Promise.reject(error);
    }
);
