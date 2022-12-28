<template lang="pug">
.row
    .col-4
        .row
            .col
                h3.h3 Фильтр поиска
                form(@submit.prevent="")
                    //- .form-group
                    //-     select.form-control(v-model="selectedSpecialization")
                    //-         option(disabled selected :value="-1") Специальность
                    //-         option(v-for="specialization in specializations" :value="specialization.id") {{ specialization.name }}
                    .form-group
                        select.form-control(v-model="selectedEducation_level")
                            option(disabled selected :value="-1") Уровень образования
                            option(v-for="education_level in education_levels" :value="education_level.id") {{ education_level.name }}
                    .form-group
                        select.form-control(v-model="selectedCity")
                            option(disabled selected :value="-1") Город 
                            option(v-for="city in citys" :value="city.id") {{ city.name }}
                    .form-group
                        select.form-control(v-model="selectedEducational_institution")
                            option(disabled selected :value="-1") Учреждение образования
                            option(v-for="educational_institution in educational_institutions" :value="educational_institution.id") {{ educational_institution.name }}
                    .form-group
                        .form-check
                            input#gridCheck.form-check-input(type='checkbox' v-model="barrierFree")
                            label.form-check-label(for='gridCheck') Наличие безбарьерной среды
                    .form-group
                        select.form-control(v-model="selectedForm_of_education")
                            option(disabled selected :value="-1") Форма получения образования
                            option(v-for="form_of_education in form_of_educations" :value="form_of_education.id") {{ form_of_education.name }}
                    button.btn.btn-primary(@click="updatePosts(event)") Фильтр
        .row
            .col
                h3.h3 Настройки для слабовидящих
                
                .theme
                    h5.h5 Цветовая схема
                    .form-check.form-check-inline
                        input#inlineRadio1.form-check-input.btn-check(type='radio' name='inlineRadioOptions' v-model="activeTheme" :value="1" @change="changeTheme(activeTheme)")
                        label.btn.btn-outline-primary.form-check-label(for='inlineRadio1') Обычная
                    .form-check.form-check-inline
                        input#inlineRadio2.form-check-input.btn-check(type='radio' name='inlineRadioOptions' v-model="activeTheme" :value="2" @change="changeTheme(activeTheme)")
                        label.btn.btn-outline-primary.form-check-label(for='inlineRadio2') Темная
                    .form-check.form-check-inline
                        input#inlineRadio3.form-check-input.btn-check(type='radio' name='inlineRadioOptions' v-model="activeTheme" :value="3" @change="changeTheme(activeTheme)")
                        label.btn.btn-outline-primary.form-check-label(for='inlineRadio3') Синяя
                .fontScale
                    h5.h5 Размер шрифта
                    .form-check.form-check-inline
                        input#inlineRadio1-f.btn-check(type='radio' name='inlineRadioOptions-f' v-model="activeFontScale" :value="1" @change="changeFontScale(activeFontScale)")
                        label.btn.btn-outline-primary.form-check-label(for='inlineRadio1-f') 100%
                    .form-check.form-check-inline
                        input#inlineRadio2-f.btn-check(type='radio' name='inlineRadioOptions-f' v-model="activeFontScale" :value="2" @change="changeFontScale(activeFontScale)")
                        label.btn.btn-outline-primary.form-check-label(for='inlineRadio2-f') 150%
                    .form-check.form-check-inline
                        input#inlineRadio3-f.btn-check(type='radio' name='inlineRadioOptions-f' v-model="activeFontScale" :value="3" @change="changeFontScale(activeFontScale)")
                        label.btn.btn-outline-primary.form-check-label(for='inlineRadio3-f') 200%



    .col
        .row.SelectedFilterElementsWrap
            .col.SelectedFilterElements
                button.btn.btn-light.ml-0(type='button' v-if="selectedSpecialization != -1" @click="selectedSpecialization = -1") {{ getSpecializationName(selectedSpecialization) }}
                button.btn.btn-light.ml-0(type='button' v-if="selectedEducation_level != -1" @click="selectedEducation_level = -1") {{ getEducation_levelName(selectedEducation_level) }}
                button.btn.btn-light.ml-0(type='button' v-if="selectedCity != -1" @click="selectedCity = -1") {{ getCityName(selectedCity) }}
                button.btn.btn-light.ml-0(type='button' v-if="selectedEducational_institution != -1" @click="selectedEducational_institution = -1") {{ getEducational_institutionName(selectedEducational_institution) }}
                button.btn.btn-light.ml-0(type='button' v-if="selectedForm_of_education != -1" @click="selectedForm_of_education = -1") {{ getForm_of_educationName(selectedForm_of_education) }}
                button.btn.btn-light.ml-0(type='button' v-if="barrierFree" @click="barrierFree = false") Наличие безбарьерной среды
        .row
            .col
                div
                    .form-check.form-check-inline
                        input#currentScreen1.form-check-input.btn-check(type='radio' name='currentScreen' v-model="currentScreen" :value="1")
                        label.btn.btn-outline-primary.form-check-label(for='currentScreen1') Записи
                    .form-check.form-check-inline
                        input#currentScreen2.form-check-input.btn-check(type='radio' name='currentScreen' v-model="currentScreen" :value="2")
                        label.btn.btn-outline-primary.form-check-label(for='currentScreen2') Карта
        .row(v-if="currentScreen == 1")
            .col
                postsVue(:posts="posts")
        .row(v-else-if="currentScreen == 2 && posts && posts.length > 0")
            .col 
                mapY(:posts="posts")
        .row(v-if="totalItems")
            .col
                VuePaginationTw(
                    :total-items="totalItems"
                    :current-page="currentPage"
                    :per-page="5"
                    @page-changed="changePageHandler"
                    :go-button="false"
                    styled="centered"
                )
    
                                    
                                    
</template>
<script>
import mapY from './map.vue'
import postsVue from './posts.vue'
export default {
    data() {
        return {
            
            selectedSpecialization: -1,
            selectedEducation_level: -1,
            selectedCity: -1,
            selectedEducational_institution: -1,
            selectedForm_of_education: -1,
            barrierFree: false,

            activeTheme: 1,
            themes: {
                1: '',
                2: 'dark',
                3: 'blue'
            },

            activeFontScale: 1,
            fontScales: {
                1: '',
                2: 'large',
                3: 'largest'
            },

            currentPage: 1,

            currentScreen: 1
        }
    },
    components: {
        mapY,
        postsVue
    },
    computed: {
        posts() {
            return this.$store.getters.posts
        },
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
        totalItems() {
            return this.$store.getters.pages
        }
    },
    created() {
        this.currentPage = +this.$route.params.id
        this.$store.dispatch('getPosts', {
            page: this.currentPage
        })
    },
    methods: {
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

        changeTheme(theme) {
            document.body.className = this.themes[this.activeTheme];
        },
        changeFontScale() {
            var d = document.getElementById("app")

            d.className = this.fontScales[this.activeFontScale];
        },

        updatePosts(e) {
            var filterData = {
                page: this.currentPage,
                selectedSpecialization: this.selectedSpecialization,
                selectedEducation_level: this.selectedEducation_level,
                selectedCity: this.selectedCity,
                selectedEducational_institution: this.selectedEducational_institution,
                selectedForm_of_education: this.selectedForm_of_education,
                barrierFree: this.barrierFree
            }

            this.$store.dispatch('getPosts', filterData)
        },

        changePageHandler(page) {
            this.currentPage = +page
            this.$router.push({ name: 'HomePosts', params: { id: +page } })
            this.updatePosts()
        }
    }
}
</script>
<style>
form .form-group {
    margin-bottom: 1rem;
}
.SelectedFilterElementsWrap {
    margin-bottom: 10px;
}
.SelectedFilterElements {
    gap: 10px;
    display: inline-flex;
    flex-wrap: wrap;
}
.SelectedFilterElements .badge {
    color: inherit;
    background: #c9c9c9;
}
.cardBottom {
    display: inline-flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}
.row{
    margin-bottom: 20px;
}
</style>