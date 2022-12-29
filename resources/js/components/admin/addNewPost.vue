<template lang="pug">
form(@submit.prevent="")
    .form-group.label-floating
        label.control-label(for='title') Название
        input#name.form-control(type='text' v-model="title" name='title' required='' data-error='Название')
        .help-block.with-errors
    .form-group.label-floating
        label.control-label(for='description') Краткое описание
        textarea#name.form-control(type='text' v-model="description" name='description' required='' data-error='Краткое описание')
        .help-block.with-errors
    .form-group.label-floating
        label.control-label(for='content') Содержание
        textarea#name.form-control(type='text' v-model="content" name='content' required='' data-error='Содержание')
        .help-block.with-errors
    .form-group.label-floating
        label.control-label(for='imageUrl') Ссылка на картинку
        input#name.form-control(type='url' v-model="imgUrl" name='imageUrl' required='' data-error='Ссылка на картинку')
        .help-block.with-errors
    .form-group.label-floating
        label.control-label(for='phone') Телефон
        input#name.form-control(type='text' v-model="phone" name='phone' required='' data-error='Телефон')
        .help-block.with-errors
    .form-group.label-floating
        label.control-label(for='address') Адрес
        input#name.form-control(type='text' v-model="address" name='address' required='' data-error='Адрес')
        .help-block.with-errors
    .form-group.label-floating
        label.control-label(for='coords') Координаты
        input#name.form-control(type='text' v-model="coords" name='coords' required='' data-error='Координаты')
        .help-block.with-errors
    .form-group
        label.control-label Уровень образования
        select.form-control(v-model="selectedEducation_level")
            option(disabled :value="-1") Уровень образования
            option(v-for="education_level in education_levels" :value="education_level.id") {{ education_level.name }}
    .form-group
        label.control-label Город 
        select.form-control(v-model="selectedCity")
            option(disabled selected :value="-1") Город 
            option(v-for="city in citys" :value="city.id") {{ city.name }}
    .form-group
        label.control-label Учреждение образования
        select.form-control(v-model="selectedEducational_institution")
            option(disabled selected :value="-1") Учреждение образования
            option(v-for="educational_institution in educational_institutions" :value="educational_institution.id") {{ educational_institution.name }}
    .form-group
        .form-check
            input#gridCheck.form-check-input(type='checkbox' v-model="barrierFree")
            label.form-check-label(for='gridCheck') Наличие безбарьерной среды
    .form-group
        label.control-label Форма получения образования 
        select.form-control(v-model="selectedForm_of_education")
            option(disabled selected :value="-1") Форма получения образования
            option(v-for="form_of_education in form_of_educations" :value="form_of_education.id") {{ form_of_education.name }}
    .form-group
        label.control-label Специальность
        select.form-control(v-model="selectedSpecialization" multiple="multiple")
            option(disabled selected :value="-1") Специальность
            option(v-for="specialization in specializations" :value="specialization.id") {{ specialization.name }}
    .form-group
        label.control-label Особые потребности
        select.form-control(v-model="selectedSpecial_need" multiple="multiple")
            option(disabled selected :value="-1") Особые потребности
            option(v-for="special_need in special_needs" :value="special_need.id") {{ special_need.name }}
    button.btn.btn-primary(@click="AddNewPost()") Добавить новую запись
</template>
<script>
export default {
    data() {
        return {
            title: '',
            description: '',
            content: '',
            imgUrl: '',
            phone: '',
            address: '',
            coords: '',

            selectedSpecialization: [1],
            selectedEducation_level: 1,
            selectedCity: 1,
            selectedEducational_institution: 1,
            selectedForm_of_education: 1,
            selectedSpecial_need: [1],
            barrierFree: false,

        }
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
        special_needs() {
            return this.$store.getters.special_needs
        },
    },
    methods: {
        AddNewPost() {
            var postData = {
                title: this.title,
                description: this.description,
                content: this.content,
                imgUrl: this.imgUrl,
                phone: this.phone,
                address: this.address,
                coords: this.coords,

                selectedSpecialization: this.selectedSpecialization,
                selectedEducation_level: this.selectedEducation_level,
                selectedCity: this.selectedCity,
                selectedEducational_institution: this.selectedEducational_institution,
                selectedForm_of_education: this.selectedForm_of_education,
                selectedSpecial_need: this.selectedSpecial_need,
                barrierFree: this.barrierFree
            }
            this.$store.dispatch('addNewPost', postData).then((resp) => {
                console.log(resp)
                if(resp == true) {
                    alert("Запись успешно добавлена")
                    location.reload()
                }
            })
        }
    }

}
</script>