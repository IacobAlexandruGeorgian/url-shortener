<template>
    <div class="container">
        <div class="bg-light p-5">
            <form class="row" @submit.prevent="submit">
                <div class="col-8 has-validation">
                    <input type="text" class="form-control" :class='{"is-invalid": error !== ""}' id="url" placeholder="Insert a url, or the absolut path of a folder" v-model="url">
                    <div class="invalid-feedback">
                        {{ error }}
                    </div>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-success mb-3">Generate</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "TheForm",
    data() {
        return {
            url: "",
            error: ""
        }
    },

    methods: {
        submit() {
            axios.post('store', {
                'url': this.url
            }).then((response) => {
                this.$emit('form-submitted', response.data);
            }).catch((error) => {
                this.error = error.response.data;
            });
        }
    }
}
</script>
