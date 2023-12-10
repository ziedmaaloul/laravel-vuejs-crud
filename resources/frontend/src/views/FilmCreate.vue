<template>
    <div class="container">
        <h1>Create Film</h1>
        <LoaderSpinner :isLoading="isLoading" />
        <div v-if="successMessage">
            <p>{{ successMessage }}</p>
            <router-link to="/">Go to Home</router-link>
        </div>
        <form @submit.prevent="createFilm">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="titre" v-model="film.titre" />
            </div>
            <div class="form-group">
                <label for="director">Director</label>
                <input type="text" class="form-control" id="realisateur" v-model="film.realisateur" />
            </div>
            <div class="form-group">
                <label for="pays">pays</label>
                <input type="text" class="form-control" id="pays" v-model="film.pays" />
            </div>
            <div class="form-group">
                <label for="date_sortie">Release Date</label>
                <input type="date" class="form-control" id="date_sortie" v-model="film.date_sortie" />
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" class="form-control" v-model="film.description"></textarea>
            </div>
            <div class="form-group">
                <label for="poster">Poster</label>
                <input type="text" class="form-control" id="poster" v-model="film.poster" />
            </div>
            <div class="form-group">
                <label for="duree">duree</label>
                <input type="number" class="form-control" id="duree" v-model="film.duree" />
            </div>
            <div class="form-group">
                <label for="langue">langue</label>
                <input type="text" class="form-control" id="langue" v-model="film.langue" />
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import { config } from '../config.js'
import LoaderSpinner from "../components/LoaderSpinner.vue";
import { successToast } from "../plugins/plugin";

export default {
    components: {
        LoaderSpinner,
    },
    data() {
        return {
            isLoading: false,
            film: {
                titre: '',
                realisateur: '',
                pays: '',
                date_sortie: '',
                description: '',
                poster: '',
                duree: '',
                langue: '',
            },
            error: null,
        };
    },
    methods: {
        createFilm() {
            this.isLoading = true;
            axios
                .post(config.baseUri + '/films', this.film)
                .then(response => {
                    this.isLoading = false;
                    successToast(
                        "Film created!"
                    );
                    setTimeout(() => {
                        this.$router.push('/films/list');
                    }, 2000)
                })
                .catch(error => {
                    this.isLoading = false;
                    this.error = error.response.data.message;
                });
        },
    },
};
</script>
