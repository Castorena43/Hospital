<template>
    <div>
        <input
            type="button"
            value="LogOut"
            class="btn btn-warning"
            v-on:click="logout"
        />
        <input
            type="button"
            value="Generar Token"
            class="btn btn-success"
            v-on:click="token"
        />
        <input
            type="button"
            value="Remove Token"
            class="btn btn-danger"
            v-on:click="removeToken"
        />
    </div>
</template>

<script>
export default {
    mounted() {
        console.log("Component mounted.");
    },
    data() {
        return {};
    },
    methods: {
        logout: function() {
            axios
                .post("/logout")
                .then(response => {
                    window.location.href = "/login";
                })
                .catch(error => {
                    console.log(error);
                    window.location.href = "/login";
                });
        },
        token: function() {
            let pToken = document.querySelector("#token");
            // console.log("token");
            axios
                .post("/generar")
                .then(response => {
                    console.log(response.data);
                    pToken.textContent = "Token: " + response.data.token;
                })
                .catch(error => {
                    console.log(error.response.data);
                });
        },
        removeToken: function() {
            let pToken = document.querySelector("#token");
            axios
                .post("/eliminartoken")
                .then(response => {
                    // console.log(response.data.token);
                    pToken.textContent = "Token: ";
                })
                .catch(error => {
                    console.log(error.response.data);
                });
        }
    }
};
</script>
