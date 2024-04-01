<template>
    <div class="container">
        <div class="bg-light p-5 rounded">
            <h2>Page not found</h2>
            <p>This page could not be found - return to dashboard <router-link :to="{name: 'dashboard'}">Dashboard</router-link>.</p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'NotFoundPage',
}
</script>
