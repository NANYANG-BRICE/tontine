<template>
    <VCard class="mb-2">
        <VExpansionPanels variant="accordion">
            <VExpansionPanel v-for="item in 1" :key="item">
                <VExpansionPanelTitle>
                    Filtres des Inscriptions
                </VExpansionPanelTitle>
                <VExpansionPanelText>

                    <VRow justify='end'>
                        <VCol cols="12" md="3">
                            <VTextField type="datetime-local" label="Date Début" density="compact" />
                        </VCol>
                        <VCol cols="12" md="3">
                            <VTextField type="datetime-local" label="Date Clôture" density="compact" />
                        </VCol>
                        <VCol cols="12" md="4">
                            <VSelect :items="items_poste_actuel" label="Poste Actuel" density="compact" clearable />
                        </VCol>
                    </VRow>


                    <VRow>
                        <VCol cols="12" md="2">
                            <VDialog v-model="ajouter" persistent class="v-dialog-md">
                                <!-- Dialog Activator -->
                                <template #activator="{ props }">
                                    <VBtn color="primary" size="small" block class="mt-1" v-bind="props">
                                        Ajouter
                                        <VIcon icon="mdi-add-circle-outline" class="ml-1" />
                                    </VBtn>
                                </template>

                                <!-- Dialog Content -->
                                <VCard title="Nouvelle Inscription ?">
                                    <VForm ref="newInscription" @submit.prevent="newInscription">
                                        <VCardText>
                                            <VRow>
                                                <VCol md="8" cols="12">
                                                    <VAutocomplete prepend-inner-icon="mdi-account-outline"
                                                        label="Utilisateur Concerné" density="compact" :items="utilisateur"
                                                        v-model="account.utilisateur_id" clearable
                                                        :rules="[rules.required]" />
                                                </VCol>

                                                <VCol md="4" cols="12">
                                                    <VTextField label="Type de Compte" density="compact"
                                                        prepend-inner-icon="mdi-account-badge-outline" readonly
                                                        v-model="account.type_compte" />
                                                </VCol>

                                                <VCol md="4" cols="12">
                                                    <VTextField label="Téléphone" density="compact"
                                                        prepend-inner-icon="mdi-phone-classic" readonly
                                                        v-model="account.telephone" />
                                                </VCol>

                                                <VCol md="4" cols="12">
                                                    <VTextField label="Montant à Déposer" density="compact"
                                                        prepend-inner-icon="mdi-currency-usd"
                                                        :rules="[rules.required, rules.min]"
                                                        v-model="account.montant_a_deposer" clearable />
                                                </VCol>

                                                <VCol md="4" cols="12">
                                                    <VTextField label="Montant Déposé" density="compact"
                                                        prepend-inner-icon="mdi-wallet-outline" readonly
                                                        v-model="account.deja_verser" />
                                                </VCol>

                                                <VCol md="4" cols="12">
                                                    <VTextField label="Noms" density="compact"
                                                        prepend-inner-icon="mdi-account-outline" readonly
                                                        v-model="account.nom" />
                                                </VCol>

                                                <VCol md="4" cols="12">
                                                    <VTextField label="Prénoms" density="compact"
                                                        prepend-inner-icon="mdi-account-outline" readonly
                                                        v-model="account.prenom" />
                                                </VCol>

                                                <VCol md="4" cols="12">
                                                    <VTextField label="Association" density="compact"
                                                        prepend-inner-icon="mdi-account-outline" readonly
                                                        v-model="account.association" />
                                                </VCol>

                                                <VCol md="8" cols="12">
                                                    <VAutocomplete prepend-inner-icon="mdi-account-child-outline"
                                                        label="Opérateur de Paiement" density="compact"
                                                        :items="['Orange Money', 'Mobile Money', 'Association']"
                                                        v-model="account.operateur" clearable />
                                                </VCol>

                                                <VCol md="4" cols="12">
                                                    <VTextField label="Poste actuel" density="compact"
                                                        prepend-inner-icon="mdi-account-tie-hat" readonly
                                                        v-model="account.poste_actuel" />
                                                </VCol>

                                                <VCol cols="12">
                                                    <VTextarea prepend-inner-icon="mdi-comment-outline" label="Description"
                                                        rows="3" v-model="account.description" clearable />
                                                </VCol>
                                            </VRow>
                                        </VCardText>

                                        <VCardActions>
                                            <VBtn color="primary" @click="getOneUtilisateur" variant="outlined"
                                                size="small">
                                                Rechercher <v-icon aria-hidden="false"
                                                    class="mx-2">mdi-account-search-outline</v-icon>
                                            </VBtn>
                                            <VSpacer />
                                            <VBtn type="submit" variant="outlined" size="small" color="primary">
                                                Enregistrer
                                                <v-icon aria-hidden="false"
                                                    class="mx-2">mdi-content-save-all-outline</v-icon>
                                            </VBtn>
                                            <VBtn variant="outlined" size="small" color="error" @click="reset">
                                                Annuler
                                                <v-icon aria-hidden="false" class="mx-2">mdi-autorenew</v-icon>
                                            </VBtn>
                                        </VCardActions>
                                    </VForm>
                                </VCard>
                            </VDialog>
                        </VCol>

                        <VCol cols="12" md="3">
                            <VSelect :items="['masculin', 'feminin']" label="Sexe" density="compact" clearable />
                        </VCol>

                        <VCol cols="12" md="3">
                            <VSelect :items="items_type_compte" label="Type de Compte" density="compact" clearable />
                        </VCol>

                        <VCol cols="12" md="4">
                            <VTextField label="Search" v-model="search" clearable append-inner-icon="mdi-magnify"
                                density="compact" />
                        </VCol>
                    </VRow>
                </VExpansionPanelText>
            </VExpansionPanel>
        </VExpansionPanels>
    </VCard>

    <VCard>
        <VCardText>
            <VRow>
                <v-data-table :headers="headers" :items="inscriptions" item-value="name" :search="search"
                    :items-per-page="4">

                    <!-- status -->
                    <template #item.status="{ item }">
                        <VChip :color="resolveStatusVariant(item.raw.status).color" class="font-weight-medium" size="small">
                            {{ resolveStatusVariant(item.raw.status).text }}
                        </VChip>
                    </template>

                    <!-- status -->
                    <template #item.est_ancien="{ item }">
                        <span> {{ resolveTypeCompteVariant(item.raw.est_ancien).text }} </span>
                    </template>

                    <!-- status -->
                    <template #item.montant="{ item }">
                        <span> {{ resolveMontantVariant(item.raw.montant).text }} fcfa </span>
                    </template>

                    <!-- Actions -->
                    <template #item.actions="{ item }">
                        <div class="d-flex gap-1">
                            <v-menu>
                                <template v-slot:activator="{ props }">
                                    <v-btn icon="mdi-cog-outline" v-bind="props" size="small" color=""></v-btn>
                                </template>

                                <v-list>
                                    <v-list-item>
                                        <v-list-item-title>
                                            <VBtn type="submit" color="" size="small" @click="consult(item.raw)">
                                                Consulter <v-icon aria-hidden="false" class="mx-2">mdi-eye-outline</v-icon>
                                            </VBtn>
                                        </v-list-item-title>


                                        <v-list-item-title>
                                            <VBtn type="submit" color="" size="small" @click="modification(item.raw)">
                                                Modifier <v-icon aria-hidden="false"
                                                    class="mx-2">mdi-notebook-edit-outline</v-icon>
                                            </VBtn>
                                        </v-list-item-title>


                                        <v-list-item-title :class="item.raw.status != 'actif' ? 'd-none' : ''">
                                            <VBtn type="submit" color="" size="small" @click="desableInscription(item.raw)">
                                                Désactiver <v-icon aria-hidden="false"
                                                    class="mx-2">mdi-close-outline</v-icon>
                                            </VBtn>
                                        </v-list-item-title>


                                        <v-list-item-title :class="item.raw.status != 'inactif' ? 'd-none' : ''">
                                            <VBtn type="submit" color="" size="small" @click="enableInscription(item.raw)">
                                                Réactiver <v-icon aria-hidden="false"
                                                    class="mx-2">mdi-check-decagram-outline</v-icon>
                                            </VBtn>
                                        </v-list-item-title>


                                        <v-list-item-title>
                                            <VBtn type="submit" color="" size="small" @click="deleteInscription(item.raw)">
                                                Supprimer <v-icon aria-hidden="false"
                                                    class="mx-2">mdi-trash-can-outline</v-icon>
                                            </VBtn>
                                        </v-list-item-title>
                                    </v-list-item>
                                </v-list>
                            </v-menu>
                        </div>
                    </template>
                </v-data-table>
            </VRow>
        </VCardText>
    </VCard>


    <VDialog v-model="modifier" persistent class="v-dialog-md">
        <!-- Dialog Content -->
        <VCard title="Modification d'une Inscription ">
            <VCardText>
                <VForm ref="updateInscription" @submit.prevent="updateInscription">
                    <VRow class="text-center mb-1">
                        <VCol cols="12" md="5">
                            <VTextField label="Noms & Prénoms" density="compact" readonly
                                prepend-inner-icon="mdi-account-outline" v-model="account.nom_complet" />
                        </VCol>

                        <VCol cols="12" md="3">
                            <VTextField label="Monant modifiable (fcfa)" density="compact" type="number"
                                oninput="validity.valid||(value='');" onpress="isNumber(event)"
                                prepend-inner-icon="mdi-wallet-outline" v-model="account.montant_a_deposer" />
                        </VCol>

                        <VCol cols="12" md="4">
                            <VTextField label="Date Versement" density="compact" readonly
                                prepend-inner-icon="mdi-calendar-check-outline" v-model="account.date" />
                        </VCol>

                        <VCol cols="12" md="3">
                            <VTextField label="Poste Actuel" density="compact" readonly
                                prepend-inner-icon="mdi-account-tie-hat" v-model="account.poste_actuel" />
                        </VCol>

                        <VCol cols="12" md="2">
                            <VTextField label="Type de Compte" density="compact" readonly
                                prepend-inner-icon="mdi-account-outline" v-model="account.type_compte" />
                        </VCol>

                        <VCol cols="12" md="3">
                            <VTextField label="Opérateur de Paiement" density="compact" readonly
                                prepend-inner-icon="mdi-home-switch-outline" v-model="account.operateur" />
                        </VCol>

                        <VCol cols="12" md="4">
                            <VTextField label="Monant total Versé (fcfa)" density="compact" readonly
                                prepend-inner-icon="mdi-wallet-outline" v-model="account.deja_verser" />
                        </VCol>

                        <VCol cols="12" md="8">
                            <VTextField label="Association D'appartenance" density="compact" readonly
                                prepend-inner-icon="mdi-home-circle-outline" v-model="account.association" />
                        </VCol>

                        <VCol cols="12" md="4">
                            <VTextField label="Statut Incription" density="compact" readonly
                                prepend-inner-icon="mdi-account-badge-outline" v-model="account.statut" />
                        </VCol>

                        <VCol cols="12">
                            <VTextarea prepend-inner-icon="mdi-comment-outline" label="Description" rows="3" readonly
                                v-model="account.description" />
                        </VCol>
                    </VRow>
                </VForm>
            </VCardText>


            <VCardActions>
                <VSpacer />
                <VBtn color="primary" @click="reset" variant="outlined" size="small">
                    Modifier <v-icon aria-hidden="false" class="mx-2">mdi-content-save-all-outline</v-icon>
                </VBtn>
                <VBtn color="error" @click="reset" variant="outlined" size="small">
                    Annuler <v-icon aria-hidden="false" class="mx-2">mdi-close-outline</v-icon>
                </VBtn>
            </VCardActions>
        </VCard>
    </VDialog>

    <VDialog v-model="consulter" persistent class="v-dialog-md">
        <VCard title="Informations d'une Inscription">
            <VCardText>
                <VForm ref="viewInscription" @submit.prevent="viewInscription">
                    <VRow class="text-center mb-1">
                        <VCol cols="12" md="8">
                            <VTextField label="Noms & Prénoms" density="compact" readonly
                                prepend-inner-icon="mdi-account-outline" v-model="account.nom_complet" />
                        </VCol>

                        <VCol cols="12" md="4">
                            <VTextField label="Date Versement" density="compact" readonly
                                prepend-inner-icon="mdi-calendar-check-outline" v-model="account.date" />
                        </VCol>

                        <VCol cols="12" md="3">
                            <VTextField label="Poste Actuel" density="compact" readonly
                                prepend-inner-icon="mdi-account-tie-hat" v-model="account.poste_actuel" />
                        </VCol>

                        <VCol cols="12" md="2">
                            <VTextField label="Type de Compte" density="compact" readonly
                                prepend-inner-icon="mdi-account-outline" v-model="account.type_compte" />
                        </VCol>

                        <VCol cols="12" md="3">
                            <VTextField label="Opérateur de Paiement" density="compact" readonly
                                prepend-inner-icon="mdi-home-switch-outline" v-model="account.operateur" />
                        </VCol>

                        <VCol cols="12" md="4">
                            <VTextField label="Monant Versé (fcfa)" density="compact" readonly
                                prepend-inner-icon="mdi-wallet-outline" v-model="account.deja_verser" />
                        </VCol>

                        <VCol cols="12" md="8">
                            <VTextField label="Association D'appartenance" density="compact" readonly
                                prepend-inner-icon="mdi-home-circle-outline" v-model="account.association" />
                        </VCol>

                        <VCol cols="12" md="4">
                            <VTextField label="Statut Incription" density="compact" readonly
                                prepend-inner-icon="mdi-account-badge-outline" v-model="account.statut" />
                        </VCol>

                        <VCol cols="12">
                            <VTextarea prepend-inner-icon="mdi-comment-outline" label="Description" rows="3" readonly
                                v-model="account.description" />
                        </VCol>
                    </VRow>
                </VForm>
            </VCardText>

            <VCardActions>
                <VSpacer />
                <VBtn color="error" @click="reset" variant="outlined" size="small">
                    Fermer <v-icon aria-hidden="false" class="mx-2">mdi-close-outline</v-icon>
                </VBtn>
            </VCardActions>
        </VCard>
    </VDialog>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'
import { useToast } from 'vue-toast-notification'
import 'vue-toast-notification/dist/theme-sugar.css'
import { VDataTable } from 'vuetify/labs/VDataTable'


export default {
    components: {
        VDataTable,
    },



    setup() {
        const toast = useToast();
        const search = ref('')
        const consulter = ref(false)
        const ajouter = ref(false)
        const modifier = ref(false)
        const headers = [
            { title: 'ID', sortable: false, key: 'id', },
            { title: 'NOMS & PRÉNOMS', key: 'nom_complet', },
            { title: 'POSTE ACTUEL', key: 'poste', },
            { title: 'MONTANT', key: 'montant', },
            { title: 'TYPE COMPTE', key: 'est_ancien', },
            { title: 'DATE VERSEMENT', key: 'created_at', },
            { title: 'STATUT', key: 'status', },
            { title: 'ACTIONS', sortable: false, key: 'actions', },
        ]
        const resolveStatusVariant = status => {
            if (status === 'actif') { return { color: 'success', text: 'Actif', } }
            else { return { color: 'error', text: 'Inactif', } }
        }

        const resolveTypeCompteVariant = est_ancien => {
            if (est_ancien === 'oui') { return { color: '', text: 'ancien', } }
            else { return { color: '', text: 'nouveau', } }
        }

        const resolveMontantVariant = montant => {
            return { color: '', text: parseInt(montant) }
        }


        return {
            toast,
            search,
            ajouter,
            headers,
            consulter,
            modifier,
            resolveStatusVariant,
            resolveMontantVariant,
            resolveTypeCompteVariant,
        }
    },



    data() {
        return {
            search: '',
            inscriptions: [],
            utilisateur: [],
            utilisateur: [],
            items_poste_actuel: [],
            items_type_compte: [],

            account: {
                utilisateur_id: '',
                type_compte: '',
                telephone: '',
                date: '',
                montant_a_deposer: 0,
                deja_verser: 0,
                nom: '',
                prenom: '',
                nom_complet: '',
                operateur: '',
                association: '',
                operateur: '',
                poste_actuel: '',
                statut: '',
                description: '',
            },

            rules: {
                required: value => !!value || 'Désolé mais ce champ est obligatoire.',
                min: value => value >= 100 || "Désolé mais le montant doit être d'au moins 100 fcfa",
            },
        }
    },



    created() {
        this.getInscription();
        this.getUtilisateur();
    },



    methods: {
        async newInscription() {
            try {
                if (this.$refs.newInscription.validate()) {
                    let utilisateur = this.account.utilisateur_id.split('-)')
                    Swal.fire({
                        title: 'Êtes vous sûres ?',
                        html: "Souhaitez vous effectuer le versement de <b style='color:red'>" + parseInt(data.montant) + " Fcfa</b> pour le compte de l'inscription de l'utilisateur <b>" + utilisateur[1].toUpperCase() + " </b>  ceci pour un montant de  ?",
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: "Je le souhaite",
                        denyButtonText: `Annuler`,
                        cancelButtonText: `Annuler`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            axios.post('new_inscription', {
                                utilisateur_id: utilisateur[0],
                                montant: this.account.montant_a_deposer,
                                operateur: this.operateur,
                            }).then(response => {
                                if (response.data.status === 408) {
                                    this.toast.warning(response.data.alert, { position: 'top-right', duration: 7500 })
                                } else if (response.data.status === 409) {
                                    this.toast.error(response.data.alert, { position: 'top-right', duration: 7500 })
                                } else if (response.data.status === 200) {
                                    this.getInscription();
                                    this.toast.success(response.data.alert + ' ' + tab_mois[ladate.getMonth()], { position: 'top-right', duration: 7500 })
                                }
                            })
                        }
                    })
                } else {
                    this.toast.error('Données abscentes ou incorrectes', { position: 'top-right', duration: 7500 })
                }
            } catch (error) {
                console.log(error)
            }
        },

        async updateInscription() {
            try {
                if (this.$refs.updateInscription.validate()) {
                    let utilisateur = this.account.utilisateur_id.split('-)')
                    Swal.fire({
                        title: 'Êtes vous sûres ?',
                        html: "Souhaitez vous modifier le versement de <b style='color:red'>" + parseInt(data.montant) + " Fcfa</b> pour le compte de l'inscription de l'utilisateur <b>" + utilisateur[1].toUpperCase() + " </b> ?",
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: "Je le souhaite",
                        denyButtonText: `Annuler`,
                        cancelButtonText: `Annuler`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            axios.post('new_inscription', {
                                utilisateur_id: utilisateur[0],
                                montant: this.account.montant_a_deposer,
                                operateur: this.operateur,
                            }).then(response => {
                                if (response.data.status === 408) {
                                    this.toast.warning(response.data.alert, { position: 'top-right', duration: 7500 })
                                } else if (response.data.status === 409) {
                                    this.toast.error(response.data.alert, { position: 'top-right', duration: 7500 })
                                } else if (response.data.status === 200) {
                                    this.getInscription();
                                    this.toast.success(response.data.alert + ' ' + tab_mois[ladate.getMonth()], { position: 'top-right', duration: 7500 })
                                }
                            })
                        }
                    })
                } else {
                    this.toast.error('Données abscentes ou incorrectes', { position: 'top-right', duration: 7500 })
                }
            } catch (error) {
                console.log(error)
            }
        },

        async reset() {
            this.ajouter = false;
            this.modifier = false;
            this.consulter = false;
            this.account.nom_complet = '';
            this.account.date = '';
            this.account.poste_actuel = '';
            this.account.type_compte = '';
            this.account.operateur = '';
            this.account.deja_verser = 0 + ' fcfa';
            this.account.association = '';
            this.account.statut = '';
        },

        async consult(data) {
            this.consulter = true;
            this.account.nom_complet = data.nom_complet;
            this.account.date = data.created_at;
            this.account.poste_actuel = data.poste;
            (data.est_ancien == 'oui') ? this.account.type_compte = 'ancien' : this.account.type_compte = 'nouveau';
            this.account.operateur = data.operateur;
            this.account.deja_verser = parseInt(data.montant) + ' fcfa';
            this.account.association = data.association;
            this.account.statut = data.status;
            this.account.description = data.description;
        },

        async modification(data) {
            try {
                axios.get('check_inscription/' + data.id).then((response) => {
                    let data = response.data;
                    this.modifier = true;
                    this.account.nom_complet = data.nom + ' ' + data.prenom;
                    this.account.montant_a_deposer = parseInt(data.montant);
                    this.account.date = data.created_at;
                    this.account.poste_actuel = data.poste_actuel;
                    (data.est_ancien == 'oui') ? this.account.type_compte = 'ancien' : this.account.type_compte = 'nouveau';
                    this.account.operateur = data.operateur;
                    this.account.deja_verser = parseInt(data.montant) + ' fcfa';
                    this.account.association = data.association;
                    this.account.statut = data.status;
                    this.account.description = data.description;
                }).catch((error) => {
                    console.log(error)
                });
            }
            catch (error) {
                console.log(error);
            }


        },

        async getInscription() {
            try {
                axios.get('inscription').then((response) => {
                    this.inscriptions = response.data;
                }).catch((error) => {
                    console.log(error)
                });
            }
            catch (error) {
                console.log(error);
            }
        },

        async getUtilisateur() {
            try {
                axios.get('utilisateur_actifs').then((response) => {
                    this.utilisateur = response.data;
                    for (let i = 0; i < response.data.length; i++) {
                        this.utilisateur[i] = response.data[i].id + '-) ' + response.data[i].nom.toUpperCase() + ' ' + response.data[i].prenom.charAt(0).toUpperCase() + response.data[i].prenom.slice(1)
                    }
                }).catch((error) => {
                    console.log(error)
                });
            }
            catch (error) {
                console.log(error);
            }
        },

        async getOneUtilisateur() {
            try {
                axios.get('one/' + this.account.utilisateur_id).then((response) => {
                    let data = response.data;
                    this.account.nom = data.nom;
                    this.account.prenom = data.prenom;
                    this.account.date = data.created_at;
                    this.account.poste_actuel = data.poste_actuel;
                    (data.est_ancien == 'oui') ? this.account.type_compte = 'ancien' : this.account.type_compte = 'nouveau';
                    this.account.operateur = data.operateur;
                    this.account.deja_verser = parseInt(data.deja_verser) + ' fcfa';
                    this.account.association = data.association;
                    this.account.statut = data.status;
                    this.account.description = 'Rien à signaler pour l\'instant.';
                }).catch((error) => {
                    console.log(error)
                })
            }
            catch (error) {
                console.log(error);
            }
        },

        async enableInscription(data) {
            console.log(data)
            Swal.fire({
                title: 'Êtes vous sûres ?',
                html: "Souhaitez vous désactivé l'inscription de <b>" + data.nom_complet.toUpperCase() + " </b>  ceci pour un montant de <b style='color:red'>" + parseInt(data.montant) + " Fcfa</b> ?",
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: "Je le souhaite",
                denyButtonText: `Annuler`,
                cancelButtonText: `Annuler`,
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post("on_inscription/" + data.id).then((response) => {
                        if (response.data.status === 409) {
                            this.toast.error(response.data.alert, { position: 'top-right', duration: 7500 });
                        } else if (response.data.status === 200) {
                            this.getInscription();
                            this.toast.success(response.data.alert, { position: 'top-right', duration: 7500 });
                        }
                    });
                }
            })
        },

        async desableInscription(data) {
            Swal.fire({
                title: 'Êtes vous sûres ?',
                html: "Souhaitez vous désactivé l'inscription de <b>" + data.nom_complet.toUpperCase() + " </b> ceci pour un montant de <b style='color:red'>" + parseInt(data.montant) + " Fcfa</b> ?",
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: "Je le souhaite",
                denyButtonText: `Annuler`,
                cancelButtonText: `Annuler`,
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post("off_inscription/" + data.id).then((response) => {
                        if (response.data.status === 409) {
                            this.toast.error(response.data.alert, { position: 'top-right', duration: 7500 });
                        } else if (response.data.status === 200) {
                            this.getInscription();
                            this.toast.success(response.data.alert, { position: 'top-right', duration: 7500 });
                        }
                    });
                }
            })
        },

        async deleteInscription(data) {
            Swal.fire({
                title: 'Êtes vous sûres ?',
                html: "Souhaitez vous supprimé l'inscription de <b>" + data.nom_complet.toUpperCase() + " </b> ceci pour un montant de <b style='color:red'>" + parseInt(data.montant) + " Fcfa</b> ?",
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: "Je le souhaite",
                denyButtonText: `Annuler`,
                cancelButtonText: `Annuler`,
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post("delete_inscription/" + data.id).then((response) => {
                        if (response.data.status === 409) {
                            this.toast.error(response.data.alert, { position: 'top-right', duration: 7500 });
                        } else if (response.data.status === 200) {
                            this.getInscription();
                            this.toast.success(response.data.alert, { position: 'top-right', duration: 7500 });
                        }
                    });
                }
            })
        },
    }
}

function isNumber(evt) {
    evt = evt ? evt : window.event
    let charCode = evt.which ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode !== 46) {
        evt.preventDefault()
    } else {
        return true
    }
}

</script>