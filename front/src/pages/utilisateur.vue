<template>
  <VCard class="mb-2">
    <VExpansionPanels variant="accordion">
      <VExpansionPanel v-for="item in 1" :key="item">
        <VExpansionPanelTitle> Filtres des Utilisateurs </VExpansionPanelTitle>
        <VExpansionPanelText>
          <VRow justify="end">
            <VCol cols="12" md="3">
              <VTextField v-model="filters.date_debut" type="datetime-local" label="Date Minimale" density="compact" />
            </VCol>
            <VCol cols="12" md="3">
              <VTextField v-model="filters.date_fin" type="datetime-local" label="Date Maximale" density="compact" />
            </VCol>
            <VCol cols="12" md="4">
              <VSelect v-model="filters.nom_role" :items="filters.poste" label="Poste Actuel" density="compact"
                clearable />
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
                <VCard title="Nouvelle Utilisateur ?">
                  <VForm ref="new" @submit.prevent="new_utilisateur">
                    <VCardText>
                      <VRow>
                        <VCol md="4" cols="12">
                          <VAutocomplete prepend-inner-icon="mdi-account-outline" label="Role de l'Utilisateur"
                            density="compact" clearable v-model="account.role_id" :rules="[rules.required]"
                            :items="account.roles" />
                        </VCol>

                        <VCol md="4" cols="12">
                          <VTextField label="utilisateur" density="compact" prepend-inner-icon="mdi-home-circle-outline"
                            readonly v-model="account.parametre_id" :rules="[rules.required]" />
                        </VCol>

                        <VCol cols="12" md="4">
                          <VSelect v-model="account.sexe" :items="['masculin', 'feminin']" label="Sexe"
                            density="compact" clearable :rules="[rules.required]" />
                        </VCol>

                        <VCol md="4" cols="12">
                          <VTextField label="Noms" density="compact" prepend-inner-icon="mdi-account-outline" clearable
                            v-model="account.nom" :rules="[rules.required, rules.min]" />
                        </VCol>

                        <VCol md="4" cols="12">
                          <VTextField label="Prénoms" density="compact" prepend-inner-icon="mdi-account-outline"
                            v-model="account.prenom" clearable />
                        </VCol>

                        <VCol cols="12" md="4">
                          <VSelect v-model="account.est_ancien" :items="['ancien', 'nouveau']"
                            prepend-inner-icon="mdi-account-badge-outline" label="Type de Compte" density="compact"
                            clearable :rules="[rules.required]" />
                        </VCol>

                        <VCol md="4" cols="12">
                          <VTextField label="Téléphone" density="compact" prepend-inner-icon="mdi-phone-classic"
                            type="number" oninput="validity.valid||(value='');" onpress="isNumber(event)" clearable
                            v-model="account.telephone" :rules="[rules.required, rules.phone]"
                            placeholder="237657807309" />
                        </VCol>

                        <VCol md="4" cols="12">
                          <VTextField label="Email" density="compact" prepend-inner-icon="mdi-email-outline" clearable
                            v-model="account.email" :rules="[rules.required, rules.email]" />
                        </VCol>

                        <VCol cols="12" md="4">
                          <VFileInput v-model="account.photo" label="Photo Profile" accept="image/*" clearable
                            prepend-icon="" prepend-inner-icon="mdi-folder-open-outline" density="compact" />
                        </VCol>

                        <VCol cols="12">
                          <VTextarea v-model="account.description" prepend-inner-icon="mdi-comment-outline"
                            label="Description" rows="3" />
                        </VCol>
                      </VRow>
                    </VCardText>

                    <VCardActions>
                      <VSpacer />
                      <VBtn type="submit" variant="outlined" size="small" color="primary">
                        Enregistrer
                        <v-icon aria-hidden="false" class="mx-2">mdi-content-save-all-outline</v-icon>
                      </VBtn>
                      <VBtn variant="outlined" size="small" color="error" @click="ajouter = false">
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
              <VSelect :items="['ancien', 'nouveau']" label="Type de Compte" density="compact" clearable />
            </VCol>

            <VCol cols="12" md="4">
              <VTextField v-model="filters.search" label="Search" clearable append-inner-icon="mdi-magnify"
                density="compact" />
            </VCol>
          </VRow>
        </VExpansionPanelText>
      </VExpansionPanel>
    </VExpansionPanels>
  </VCard>

  <VCard>
    <VCardText class="elevation-6">


      <VRow>
        <v-data-table :headers="headers" :items="account.utilisateurs" item-value="name" :search="filters.search"
          :items-per-page="4">
          <!-- status -->
          <template #item.status="{ item }">
            <VChip :color="resolveStatusVariant(item.raw.status).color" class="font-weight-medium" size="small">
              {{ resolveStatusVariant(item.raw.status).text }}
            </VChip>
          </template>

          <!-- type compte -->
          <template #item.est_ancien="{ item }">
            {{ resolveTypeCompteVariant(item.raw.est_ancien).text }}
          </template>
          
          <!-- sexe femme -->
          <template #item.sexe="{ item }">
            <VIcon icon="mdi-face-woman" :class="item.raw.sexe != 'feminin' ? 'd-none' : ''"/>
            <VIcon icon="mdi-face-man"  :class="item.raw.sexe != 'masculin' ? 'd-none' : ''"/>
          </template>


          <!-- Actions -->
          <template #item.actions="{ item }">
            <div class="d-flex gap-1">

              <IconBtn @click="get(item.raw)">
                <VTooltip activator="parent" location="top">
                  Modier l'utilisateur {{ item.raw.nom }} {{ item.raw.prenom }}
                </VTooltip>
                <VIcon icon="mdi-pencil-outline" />
              </IconBtn>

              <IconBtn @click="desable(item.raw)" :class="item.raw.status != 'actif' ? 'd-none' : ''">
                <VTooltip activator="parent" location="top">
                  Désactiver l'utilisateur {{ item.raw.nom }} {{ item.raw.prenom }}
                </VTooltip>
                <VIcon icon="mdi-remove-circle-outline" />
              </IconBtn>

              <IconBtn @click="enable(item.raw)" :class="item.raw.status != 'inactif' ? 'd-none' : ''">
                <VTooltip activator="parent" location="top">
                  Réactiver l'utilisateur {{ item.raw.nom }} {{ item.raw.prenom }}
                </VTooltip>
                <VIcon icon="mdi-success-circle-outline" />
              </IconBtn>

              <IconBtn @click="consultation(item.raw)">
                <VTooltip activator="parent" location="top">
                  Consulter l'utilisateur {{ item.raw.nom }} {{ item.raw.prenom }}
                </VTooltip>
                <VIcon icon="mdi-eye-outline" />
              </IconBtn>

              <IconBtn @click="deletes(item.raw)" disabled>
                <VTooltip activator="parent" location="top">
                  Supprimer l'utilisateur {{ item.raw.nom }} {{ item.raw.prenom }}
                </VTooltip>
                <VIcon icon="mdi-trash-can-outline" />
              </IconBtn>
            </div>
          </template>
        </v-data-table>
      </VRow>
    </VCardText>
  </VCard>
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
      const ajouter = ref(false)
      const headers = [
        { title: 'ID', sortable: false, key: 'id', },
        { title: 'NOMS', key: 'nom', },
        { title: 'PRENOMS', key: 'prenom', },
        { title: 'SEXE', key: 'sexe', },
        { title: 'POSTE ACTUEL', key: 'nom_role', },
        { title: 'TYPE COMPTE', key: 'est_ancien', },
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
      
      const resolveSexeVariant = sexe => {
        if (sexe === 'masculin') { return { color: '', text: 'mdi-face-man', } }
        else { return { color: '', text: 'mdi-face-woman', } }
      }

      const resolveMontantVariant = montant => {
        return { color: '', text: parseInt(montant) }
      }


      return {
        toast,
        ajouter,
        headers,
        resolveStatusVariant,
        resolveMontantVariant,
        resolveTypeCompteVariant,
        resolveSexeVariant,
      }
    },



    data() {
      return {
        rules: {
          required: value => !!value || 'Désolé mais ce champ est obligatoire.',
          min: value => value >= 100 || "Désolé mais le montant doit être d'au moins 100 fcfa",
        },

        account: {
          id: '',
          matricule: '',
          parametre_id: '2-) Balanga',
          role_id: '',
          photo: '',
          nom: '',
          prenom: '',
          sexe: '',
          email: '',
          telephone: '237',
          est_ancien: '',
          description: '',
          status: '',
          created_at: '',
          nom_role: '',
          raison_sociale: '',
          utilisateur: '',
          utilisateurs: [],
          roles: [],
        },

        filters: {
          search: '',
          nom_role: '',
          poste: [],
          date_debut: '',
          date_fin: '',
          sexe: '',
          type_compte: '',
        },

        rules: {
          required: value => !!value || 'Désolé mais ce champ est obligatoire.',
          min: value => value.length >= 10 || 'Vous devez entré au moins 10 caractères',
          phone: value => (value.length >= 12 && value.length <= 12) || 'Vous devez entré exactement 12 caractères',
          max: value => value.length <= 10 || 'Vous devez entré au plus 10 caractères',
          email: value => {
            if (value.length > 0) {
              const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
              return pattern.test(value) || 'Désolé mais cette adresse e-mail est invalide.';
            }
          },

        },
      }
    },

    created() {
      this.getroles();
      this.getUtilisateurs();
    },

    methods: {
      async getroles() {
        try {
          axios.get('role').then((response) => {
            this.account.roles = response.data;
            for (let i = 0; i < response.data.length; i++) {
              this.account.roles[i] = response.data[i].id + '-) ' + response.data[i].nom;

            }
          }).catch((error) => {
            console.log(error)
          });
        }
        catch (error) {
          console.log(error);
        }
      },

      async getUtilisateurs() {
        try {
          axios.get('utilisateur').then((response) => {
            this.account.utilisateurs = response.data;
          }).catch((error) => {
            console.log(error)
          });
        }
        catch (error) {
          console.log(error);
        }
      },


      async new_utilisateur() {
        try {
          if (this.$refs.new.validate()) {
            this.ajouter = false;
            let donnee = this.account.role_id.split('-)')
            let parametre = this.account.parametre_id.split('-)')
            Swal.fire({
              title: 'Êtes vous sûres ?',
              html: "Voulez vous <b> Enregistrer </b> l'utilisateur <b>  " + this.account.nom + ' ' + this.account.prenom + "</b> en temps que <b> " + donnee[1] + " </b> ?",
              showDenyButton: true,
              showCancelButton: false,
              confirmButtonText: "Je le souhaite",
              denyButtonText: `Annuler`,
              cancelButtonText: `Annuler`,
            }).then((result) => {
              if (result.isConfirmed) {
                axios.post('new_utilisateure/', {
                  parametre_id: parametre[0],
                  role_id: donnee[0],
                  nom: this.account.nom,
                  prenom: this.account.prenom,
                  sexe: this.account.sexe,
                  email: this.account.email,
                  telephone: this.account.telephone,
                  est_ancien: (this.account.est_ancien == 'ancien') ? 'oui' : 'non',
                  description: this.account.description,
                }).then((response) => {
                  if (response.data.status === 408) {
                    this.toast.warning(response.data.alert, { position: 'top-right', duration: 7500 })
                  } else if (response.data.status === 409) {
                    this.toast.error(response.data.alert, { position: 'top-right', duration: 7500 })
                  } else if (response.data.status === 200) {
                    this.getroles();
                    this.toast.success(response.data.alert, { position: 'top-right', duration: 7500 })
                  }
                }, (error) => {
                  console.log(error);
                });
              }
            })
          } else {
            this.toast.error('Données abscentes ou incorrectes', { position: 'top-right', duration: 7500 })
          }
        } catch (error) {
          console.log(error)
        }
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
