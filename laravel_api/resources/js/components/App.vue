<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <div class="container">
                <div class="navbar-nav">
                    <router-link :to="{name: 'home'}" class="nav-item nav-link">Главная</router-link>
                    <router-link :to="{name: 'desks'}" class="nav-item nav-link">Доски</router-link>
                </div>
            </div>
        </nav>
        <div>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

