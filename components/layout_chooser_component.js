Vue.component('layout-chooser-component', {
	template: "#layout_chooser_component_template",
	data: function () {
		return {
			is_list_view: false
		}
	},
	methods: {
		changeState() {
			// change the state on click
			this.is_list_view = !this.is_list_view
		}
	}
})