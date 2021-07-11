<template>

</template>

<script>
import AppStorage from "../../Helpers/AppStorage";

export default {
    name: "Logout",
    created() {
        AppStorage.clear()
        Toast.fire({
            icon: 'warning',
            title: 'Logout successfully'
        })
        this.$router.push({name: '/'})
    },
}
</script>

<style scoped>

</style>
