<template>
    <div class="container">
        <div class="bg-light p-5 rounded">
            <ul class="list-group" v-for="url in urls" :key="url.code">
                <li v-if="url.type == 'url'" class="list-group-item">
                    <router-link :to="{name: 'url', params: {slug: url.code}}">{{domain + url.code}}</router-link>
                </li>
                <li v-if="url.type == 'path'" class="list-group-item">
                    <router-link :to="{name: 'path', params: {slug: url.code}}">{{domain + 'path/' + url.code}}</router-link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: "TheList",
    props: ['urls'],
    data() {
        return {
            domain: import.meta.env.VITE_APP_URL
        }
    }
}
</script>
