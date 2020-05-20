<template>
    <div :hidden="!mostrar">
  		<vue-loaders name="pacman" color="black" scale="0.9"></vue-loaders>
    </div>
</template>

<script>
export default {
	props: {
		mostrar: Boolean
	},
	data() {
		return {
		}
	},
	methods: {
	},
	mounted() {
	},
	created: function(){
	},
}
</script>
