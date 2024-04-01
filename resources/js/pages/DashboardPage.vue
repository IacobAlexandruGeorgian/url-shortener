<template>
    <the-header></the-header>
    <the-form @form-submitted="handleFormSubmitted"></the-form>
    <the-list :urls="urls"></the-list>
</template>

<script>
import TheHeader from '../components/TheHeader.vue'
import TheForm from '../components/TheForm.vue'
import TheList from '../components/TheList.vue'

export default {
    name: 'DashboardPage',
    components: {
        TheHeader,
        TheForm,
        TheList
    },
    data() {
        return {
            urls: []
        }
    },

    methods: {
        handleFormSubmitted(url) {
            this.urls.push(url);
        }
    }
}
</script>
