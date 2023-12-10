<template>
    <div class="container">
        <h1>Modifier le film : {{ film.titre }}</h1>
        <LoaderSpinner :isLoading="isLoading" />
        <form @submit.prevent="updateFilm">

            <div class="form-group">
                <label>Titre :</label>
                <input type="text" class="form-control" v-model="film.titre" required>
            </div>
            <div class="form-group">
                <label>Réalisateur :</label>
                <input type="text" class="form-control" v-model="film.realisateur" required>
            </div>
            <div class="form-group">
                <label>Pays :</label>
                <input type="text" class="form-control" v-model="film.pays" required>
            </div>
            <div class="form-group">
                <label>Date de sortie :</label>
                <input type="date" class="form-control" v-model="film.date_sortie" required>
            </div>
            <div class="form-group">
                <label>Description :</label>
                <textarea class="form-control" v-model="film.description"></textarea>
            </div>
            <div class="form-group">
                <label>Poster :</label>
                <input type="text" class="form-control" v-model="film.poster">
            </div>
            <div class="form-group">
                <label>Durée :</label>
                <input type="number" class="form-control" v-model="film.duree" required>
            </div>
            <div class="form-group">
                <label>Langue :</label>
                <input type="text" class="form-control" v-model="film.langue" required>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
        <p v-if="message">{{ message }}</p>
    </div>
</template>

<script>
import axios from 'axios'
import { config } from '../config.js'
import LoaderSpinner from "../components/LoaderSpinner.vue";
import { successToast } from "../plugins/plugin";

export default {
    name: 'FilmUpdate',
    components: {
        LoaderSpinner,
    },
    data() {
        return {
            isLoading: true,
            film: {
                id: '',
                titre: '',
                realisateur: '',
                pays: '',
                date_sortie: '',
                description: '',
                poster: '',
                duree: '',
                langue: ''
            },
            message: ''
        }
    },
    mounted() {
        const filmId = this.$route.params.id
        this.isLoading = true;
        axios.get(config.baseUri + `/films/${filmId}`)
            .then(response => {
                this.film = response.data.data
                this.isLoading = false;

            })
            .catch(error => {
                console.log(error)
                this.isLoading = false;

            })
    },
    methods: {
        updateFilm() {
            this.isLoading = true;

            axios.put(config.baseUri + `/films/${this.film.id}`, this.film)
                .then(response => {
                    successToast(
                        "Le film a été mis à jour avec succès."
                    );
                    this.isLoading = false;

                    setTimeout(() => {
                        this.$router.push('/films/list');
                    }, 2000)
                })
                .catch(error => {
                    this.isLoading = false;

                })
        }
    }
}
</script>
