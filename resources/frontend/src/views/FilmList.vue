<template>
    <div class="container">
        <h1>Liste des films</h1>
        <LoaderSpinner :isLoading="isLoading" />
        <div class="rows">
            <div class="card" style="width: 18rem;" v-for="film in films" :key="film.id">
                <img class="card-img-top" :src="film.poster">
                <div class="card-body">
                    <h5 class="card-title">{{ film.id }} - {{ film.titre }}</h5>
                    <p class="card-text"><strong>Realisateur : </strong>{{ film.realisateur }}</p>
                    <p class="card-text"><strong>Pays : </strong>{{ film.pays }}</p>
                    <p class="card-text"><strong>Date Sortie : </strong>{{ film.date_sortie }}</p>
                    <p class="card-text"><strong>Durée : </strong>{{ film.duree }}</p>
                    <p class="card-text"><strong>Langue : </strong>{{ film.langue }}</p>
                    <p class="card-text">{{ film.description }}</p>
                    <button @click="editFilm(film)" class="btn btn-primary">Modifier</button>
                    <button @click="deleteFilm(film)" class="btn btn-primary">Supprimer</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { config } from '../config.js';
import LoaderSpinner from "../components/LoaderSpinner.vue";
import { successToast } from "../plugins/plugin";

export default {
    name: "FilmList",
    components: {
        LoaderSpinner,
    },
    data() {
        return {
            isLoading: true,
            films: [],
        };
    },

    mounted() {
        this.fetchFilms();
    },

    methods: {
        fetchFilms() {
            this.isLoading = true;
            // Appel à l'API pour récupérer tous les films
            axios.get(config.baseUri + '/films').then(response => {
                this.isLoading = false;
                this.films = response.data.data;
            });
        },

        editFilm(film) {
            // Naviguer vers la page de modification du film
            this.$router.push(`/films/${film.id}/edit`);
        },

        deleteFilm(film) {
            // Demander confirmation avant de supprimer le film
            if (confirm(`Êtes-vous sûr de vouloir supprimer le film "${film.titre}" ?`)) {
                this.isLoading = true;
                // Appel à l'API pour supprimer le film
                axios.delete(config.baseUri + `/films/${film.id}`).then(response => {
                    // Mettre à jour la liste des films
                    this.isLoading = false;
                    successToast(
                        "Film Deleted!"
                    );
                    this.fetchFilms();
                });
            }
        },
    },
};
</script>
<style>
.rows {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}
</style>
