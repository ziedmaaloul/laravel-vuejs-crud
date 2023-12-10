<template>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Laravel VueJs Cruds</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/films/list">List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/films/create">Add</a>
                    </li>
                </ul>
            </div>
        </nav>
        <router-view />
    </div>
</template>
<script>
export default {
    name: 'App',
    components: {
    }
}
</script>
