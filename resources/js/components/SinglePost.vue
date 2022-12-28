<template lang="pug">
.container.singlePost(v-if="post")
    .row
        .col
            img.img-fluid(:src="post.image ? post.image : defaultImage")
    .row
        .col
            h1.h1 {{ post.title }}
    .row
        .col
            .SelectedFilterElements
                span.badge {{ getEducational_institutionName(post.educational_institution) }}
                span.badge {{ getEducation_levelName(post.education_level) }}
                span.badge {{ getCityName(post.city) }}
    .row
        .col
            .SelectedFilterElements
                span.badge.green(v-for="selected_specialization in post.selected_specializations") {{ getSpecializationName(selected_specialization.specialization_id) }}

    .row
        .col
            article {{ post.content }}
    .row
        .col
            .map#singleMap

        
</template>
<script>
export default {
    data(){
        return {
            defaultImage: "https://i.ytimg.com/vi/87ILM9KFZHM/maxresdefault_live.jpg",
            post: null,
            postId: null
        }
    },
    beforeMount() {
        this.postId = +this.$route.params.id

        this.$store.dispatch('getSinglePost', this.postId).then((post) => {
            this.post = post
            ymaps.ready(this.initMap);
            console.log(post)
        })
    },
    mounted() {
      
    },
    computed: {
        education_levels() {
            return this.$store.getters.education_levels
        },
        citys() {
            return this.$store.getters.citys
        },
        educational_institutions() {
            return this.$store.getters.educational_institutions
        },
        form_of_educations() {
            return this.$store.getters.form_of_educations
        },
        specializations() {
            return this.$store.getters.specializations
        },
    },
    methods: {
        initMap() {
            let address = this.post.address
            let coords = this.post.coords

            coords = coords.split(',')
            for(let keyCoords in coords) {
              coords[keyCoords] = parseFloat(coords[keyCoords])
            }
            coords = coords.reverse()

            var map = new ymaps.Map('singleMap', {
                center: coords,
                zoom: 15,
                controls: ['zoomControl']
            })

            map.geoObjects.add(new ymaps.Placemark(coords, {
                balloonContent: address,
                iconCaption: this.post.title
            }, {
                preset: 'islands#blueCircleDotIconWithCaption',
                iconCaptionMaxWidth: '50'
            }))
        },

        getSpecializationName(id) {
            let result = this.specializations.find(el => el.id == id)
            return result.name
        },
        getEducation_levelName(id) {
            let result = this.education_levels.find(el => el.id == id)
            return result.name
        },
        getCityName(id) {
            let result = this.citys.find(el => el.id == id)
            return result.name
        },
        getEducational_institutionName(id) {
            let result = this.educational_institutions.find(el => el.id == id)
            return result.name
        },
        getForm_of_educationName(id) {
            let result = this.form_of_educations.find(el => el.id == id)
            return result.name
        },
    }
}
</script>
<style>
#singleMap {
    width: 100%;
    height: 450px;
}
.SelectedFilterElements .badge.green {
    background: #52ff52;
}
</style>