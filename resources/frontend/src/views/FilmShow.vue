<template>
    <div class="container">
        <LoaderSpinner :isLoading="isLoading" />
        <h1>{{ film.titre }}</h1>

        <div>
            <p><strong>Réalisateur:</strong> {{ film.realisateur }}</p>
            <p><strong>Pays:</strong> {{ film.pays }}</p>
            <p><strong>Date de sortie:</strong> {{ film.date_sortie }}</p>
            <p><strong>Description:</strong> {{ film.description }}</p>
            <p><strong>Durée:</strong> {{ film.duree }} min</p>
            <p><strong>Langue:</strong> {{ film.langue }}</p>
            <p><strong>Poster:</strong></p>
            <img :src="film.poster" :alt="film.titre" />
        </div>
        <router-link :to="{ name: 'edit', params: { id: film.id } }" class="btn btn-primary">Modifier</router-link>
        <button @click="deleteFilm" class="btn btn-danger">Supprimer</button>
    </div>
</template>

<script>
import axios from 'axios';
import { config } from '../config.js'
import LoaderSpinner from "../components/LoaderSpinner.vue";
import { successToast } from "../plugins/plugin";

export default {
    name: 'FilmShow',
    components: {
        LoaderSpinner,
    },
    data() {
        return {
            isLoading: true,
            film: null
        }
    },
    created() {
        this.fetchFilm();
    },
    methods: {
        fetchFilm() {
            this.isLoading = true;
            // Mettre à jour la liste des films
            // Mettre à jour la liste des films
            axios.get(config.baseUri + '/films/' + this.$route.params.id)
                .then(response => {
                    this.film = response.data;
                    this.isLoading = false;

                })
                .catch(error => console.log(error));
        },
        deleteFilm() {
            if (confirm("Êtes-vous sûr de vouloir supprimer ce film?")) {
                this.isLoading = true;

                // Mettre à jour la liste des films
                // Mettre à jour la liste des films
                axios.delete(config.baseUri + '/films/' + this.$route.params.id)
                    .then(() => {
                        successToast(
                        "Film deleted!"
                    );
                        this.$router.push({ name: 'home' });
                        this.isLoading = false;

                    })
                    .catch(error => console.log(error));
            }
        }
    }
}
</script>
