<template>
    <div class="container">
        <div class="bg-light p-5">
            <form class="row">
                <div class="col-8 has-validation">
                    <input type="text" class="form-control" :class='{"is-invalid": error !== ""}' id="url" placeholder="URL" v-model="url">
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
export default {
    name: "TheForm",
    data() {
        return {
            url: "",
            error: ""
        }
    }
}
</script>
