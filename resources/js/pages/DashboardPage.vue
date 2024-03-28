<template>
    <the-header></the-header>
    <the-form></the-form>
    <the-list></the-list>
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
        
    }
}
</script>
