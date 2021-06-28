<template>
    <div class="container">
        <div class="form-group">
            <input type="text" @blur="saveName"
                   v-model="name"
                   class="form-control">
<!--                   :class="{ 'is-invalid': $v.name.$error }"-->
<!--            >-->
<!--            <div class="invalid-feedback" v-if="!$v.name.required">-->
<!--                Обязательное поле.-->
<!--            </div>-->
<!--            <div class="invalid-feedback" v-if="!$v.name.maxLength">-->
<!--                Макс. количество символов: {{ $v.name.$params.maxLength.max}}.-->
<!--            </div>-->
        </div>
        <div class="row">
            <div class="col-lg-4" v-for="card in cards">
                <div class="card mt-3">
                    <a href="#" class="nav-item nav-link">
                        <h4 class="card-title">{{ card.name }}</h4>
                    </a>
<!--                    <router-link :to="{name: 'showDesk', params: {deskId: desk.id}}" class="nav-item nav-link">-->
<!--                        <h4 class="card-title">{{ desk.name }}</h4>-->
<!--                    </router-link>-->
<!--                    <button type="button" class="btn btn-danger mt-3" @click="deleteDesk(desk.id)">-->
<!--                        Удалить</button>-->
                </div>
        </div>
    </div>
        <div class="alert alert-danger" role="alert" v-if="errored">
            Ошибка загрузки данных!
        </div>
        <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status" v-if="loading">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</template>

<script>
// import { required, maxLength } from 'vuelidate/lib/validators'
export default {
    props: [
        'deskId'
    ],
    data() {
        return {
            name: null,
            errored: false,
            loading: true,
            cards: []
        }
    },
    methods: {
        async saveName() {
            // this.$v.$touch()
            // if(this.$v.$anyError()) {
            //     return;
            // }
            try {
                const { data } =
                    await axios.patch('/api/V1/desks/'+this.deskId, {
                        name: this.name,
                    })
                this.loading = false
            } catch (error) {
                console.log(error)
                this.errored = true
            }
        }
    },
    async mounted() {
        try {
            const { data } =
                await axios.get('/api/V1/desks/'+this.deskId)
            this.name = data.data.name
            this.cards = data.data.lists
            console.log(this.cards)
            this.loading = false
        } catch (error) {
            console.log(error)
            this.errored = true
        }
    },
    // validations: {
    //     name: {
    //         required,
    //         maxLength: maxLength(255)
    //     }
    // }

}
</script>

