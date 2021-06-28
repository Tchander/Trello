<template>
    <div class="container">
        <h1>Доски</h1>
        <form @submit.prevent="addNewDesk">
            <div class="form-group">
                <input type="text" v-model="name" class="form-control" placeholder="Введите название доски">
<!--                <div class="invalid-feedback" v-if="!name">-->
<!--                    Обязательное поле.-->
<!--                </div>-->
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
        <div class="alert alert-danger mt-3" role="alert" v-if="errored">
            Ошибка загрузки данных! <br>
            {{ errors[0] }}
        </div>
        <div class="row">
            <div class="col-lg-4" v-for="desk in desks">
                <div class="card mt-3">
                    <router-link :to="{name: 'showDesk', params: {deskId: desk.id}}" class="nav-item nav-link">
                        <h4 class="card-title">{{ desk.name }}</h4>
                    </router-link>
                    <button type="button" class="btn btn-danger mt-3" @click="deleteDesk(desk.id)">
                        Удалить</button>
                </div>
            </div>
        </div>
        <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status" v-if="loading">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            desks: [],
            errors: [],
            errored: false,
            loading: true,
            name: null
        }
    },
    mounted() {
        this.getAllDesks()
    },
    methods: {
        async deleteDesk(deskId) {
            if(confirm('Вы действительно хотите удалить доску?')) {
                try {
                    this.errored = false
                    const { data } =
                        await axios.delete( '/api/V1/desks/'+deskId)
                    this.desks = []
                    await this.getAllDesks()
                    this.loading = false
                } catch (error) {
                    console.log(error)
                }

            }
        },
        async getAllDesks() {
            try {
                this.errored = false
                const { data } =
                    await axios.get('/api/V1/desks')
                this.desks = data.data
                this.loading = false
            } catch (error) {
                console.log(error)
                this.errored = true
            }
        },
        async addNewDesk() {
            try {
                this.errored = false
                const { data } =
                    await axios.post('/api/V1/desks', {
                        name: this.name
                    })
                this.name = ''
                this.desks = []
                await this.getAllDesks()
                this.loading = false
            } catch (error) {
                console.log(error)
                if (error.response.data.errors.name) {
                    this.errors = []
                    this.errors.push(error.response.data.errors.name[0])
                }
                this.errored = true
            }
        }
    }
}
</script>

