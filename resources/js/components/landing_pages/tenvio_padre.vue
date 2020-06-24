<template>
    <div>
        <tenvio-registro-component v-if="register" @register="register = false"></tenvio-registro-component>
        <tenvio-promo-component v-else @register="register = true"></tenvio-promo-component>
    </div>
</template>

<script>
    export default {
       data() {
            return {
                register: false
            }
	    }
    }
</script>
