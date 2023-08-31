<template>
  <VCard>
    <VCardText>

      <VRow justify='end' class="mb-2">

        <VCol cols="12" md="2">
          <VDialog v-model="ajouter" persistent class="v-dialog-lg">
            <!-- Dialog Activator -->
            <template #activator="{ props }">
              <VBtn color="primary" type="submit" size="small" class="mx-2 mt-1" v-bind="props" >
                <VIcon icon="mdi-add-circle-outline" class="d-sm-none" />
                <span class="d-none d-sm-block">
                  Ajouter <v-icon aria-hidden="false" class="mx-1">mdi-add-circle-outline</v-icon>
                </span>
              </VBtn>
            </template>

            <!-- Dialog Content -->
            <VCard title="Nouveau role" subtitle="Hello guys veillez renseigné les informations de votre rôle.">
              <VForm ref="new_role" @submit.prevent="new_role">
                <VCardText>
                  <VRow>
                    <VCol md="12" cols="12">
                      <VTextField v-model="role.nom" :rules="[rules.required, rules.min]" label="Nom" density="compact"
                        prepend-inner-icon="mdi-book-settings-outline" />
                    </VCol>

                    <VCol cols="12">
                      <VTextarea v-model="role.description" prepend-inner-icon="mdi-comment-outline" label="Description"
                        rows="3" />
                    </VCol>
                  </VRow>
                </VCardText>

                <VCardActions>
                  <VSpacer />
                  <VBtn color="primary" variant="outlined" size="small" type="submit" class="mx-1">
                    <VIcon icon="mdi-content-save-all-outline" class="d-sm-none" />
                    <span class="d-none d-sm-block">
                      Enregistrer <v-icon aria-hidden="false" class="mx-1">mdi-content-save-all-outline</v-icon>
                    </span>
                  </VBtn>

                  <VBtn color="error" variant="outlined" size="small" @click="ajouter = false">
                    <VIcon icon="mdi-close-outline" class="d-sm-none" />
                    <span class="d-none d-sm-block">
                      Annuler <v-icon aria-hidden="false" class="mx-1">mdi-close-outline</v-icon>
                    </span>
                  </VBtn>
                </VCardActions>
              </VForm>
            </VCard>
          </VDialog>


          <VDialog v-model="modifier" persistent class="v-dialog-lg">
            <!-- Dialog Content -->
            <VCard title="Modification d'un role" subtitle="Hello guys veillez renseigné les nouvelles informations à mettre à jour.">
              <VForm ref="update_role" @submit.prevent="update_role">
                <VCardText>
                  <VRow>
                    <VCol md="6" cols="12">
                      <VTextField v-model="role.nom" :rules="[rules.required, rules.min]" label="Nom" density="compact"
                        prepend-inner-icon="mdi-book-settings-outline" />
                    </VCol>

                    <VCol md="6" cols="12">
                      <VTextField v-model="role.sigle" :rules="[rules.required, rules.min]" label="Sigle"
                        density="compact" prepend-inner-icon="mdi-book-open-page-variant-outline" />
                    </VCol>

                    <VCol cols="12">
                      <VTextarea v-model="role.description" prepend-inner-icon="mdi-comment-outline" label="Description"
                        rows="3" />
                    </VCol>
                  </VRow>
                </VCardText>

                <VCardActions>
                  <VSpacer />
                  <VBtn color="primary" variant="outlined" size="small" type="submit" class="mx-1">
                    <VIcon icon="mdi-content-save-all-outline" class="d-sm-none" />
                    <span class="d-none d-sm-block">
                      Modifier <v-icon aria-hidden="false" class="mx-1">mdi-content-save-all-outline</v-icon>
                    </span>
                  </VBtn>

                  <VBtn color="error" variant="outlined" size="small" @click="modifier = false">
                    <VIcon icon="mdi-close-outline" class="d-sm-none" />
                    <span class="d-none d-sm-block">
                      Annuler <v-icon aria-hidden="false" class="mx-1">mdi-close-outline</v-icon>
                    </span>
                  </VBtn>
                </VCardActions>
              </VForm>
            </VCard>
          </VDialog>
        </VCol>

        <VCol cols="12" md="10">
          <VTextField label="Recherchez quelque chose...." v-model="search" append-inner-icon="mdi-magnify"
            density="compact" />
        </VCol>
      </VRow>

      <VRow>
        <v-data-table :headers="headers" :items="roles" item-value="name" :search="search" :items-per-page="4">
          <!-- status -->
          <template #item.status="{ item }">
            <VChip :color="resolveStatusVariant(item.raw.status).color" class="font-weight-medium" size="small">
              {{ resolveStatusVariant(item.raw.status).text }}
            </VChip>
          </template>

          <!-- Actions -->
          <template #item.actions="{ item }">
            <div class="d-flex gap-1">

              <IconBtn @click="get(item.raw)" >
                <VTooltip activator="parent" location="top">
                  Modier le role {{ item.raw.nom }}
                </VTooltip>
                <VIcon icon="mdi-pencil-outline" />
              </IconBtn>

              <IconBtn @click="desable(item.raw)" :class="item.raw.status != 'actif' ? 'd-none' : ''" >
                <VTooltip activator="parent" location="top">
                  Désactiver le role {{ item.raw.nom }}
                </VTooltip>
                <VIcon icon="mdi-remove-circle-outline" />
              </IconBtn>

              <IconBtn @click="enable(item.raw)" :class="item.raw.status != 'inactif' ? 'd-none' : ''" >
                <VTooltip activator="parent" location="top">
                  Réactiver le role {{ item.raw.nom }}
                </VTooltip>
                <VIcon icon="mdi-success-circle-outline" />
              </IconBtn>

              <IconBtn @click="deletes(item.raw)" >
                <VTooltip activator="parent" location="top">
                  Supprimer le role {{ item.raw.nom }}
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
import axios from "axios";
import Swal from 'sweetalert2';
import { useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import { VDataTable } from 'vuetify/labs/VDataTable';


export default {
  components: {
    VDataTable,
  },

  setup() {
    const toast = useToast();
    const search = ref('')
    const ajouter = ref(false)
    const modifier = ref(false)
    const headers = [
      { title: 'ID', sortable: false, key: 'id', },
      { title: 'NOM', key: 'nom', },
      { title: 'DESCRIPTION', key: 'description', },
      { title: 'STATUT', key: 'status', },
      { title: 'DATE DE CREATION', key: 'created_at', },
      { title: 'ACTIONS', sortable: false, key: 'actions', },
    ]
    const resolveStatusVariant = status => {
      if (status === 'actif')
        return {
          color: 'primary',
          text: 'Actif',
        }
      else
        return {
          color: 'error',
          text: 'Inactif',
        }
    }

    return {
      toast,
      search,
      headers,
      ajouter,
      modifier,
      resolveStatusVariant,
    }
  },

  data() {
    return {
      actif: false,
      inactif: false,
      roles: [],
      role: {
        id: '',
        nom: '',
        description: '',
      },
      rules: {
        required: value => !!value || 'Désolé mais ce champ est obligatoire.',
        min: value => value.length >= 5 || 'Vous devez entré au moins 05 caractères',
      },
    }
  },

  created() {
    this.getroles();
  },


  methods: {
    async new_role() {
      try {
        if (this.$refs.new_role.validate()) {
          this.ajouter = false;
          Swal.fire({
            title: 'Êtes vous sûres ?',
            html: "Voulez vous <b> Enregistrer </b> le role <b>  " + this.role.nom + "</b> ?",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Je le souhaite",
            denyButtonText: `Annuler`,
            cancelButtonText: `Annuler`,
          }).then((result) => {
            if (result.isConfirmed) {
              axios.post('new_role/', {
                nom: this.role.nom,
                description: this.role.description
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



    async get(data) {
      this.modifier = true;
      this.role.id = data.id;
      this.role.nom = data.nom;
      this.role.sigle = data.sigle;
      this.role.description = data.description;
    },

    async update_role() {
      try {
        if (this.$refs.update_role.validate()) {
          this.modifier = false;
          Swal.fire({
            title: 'Êtes vous sûres ?',
            html: "Voulez vous <b> Modifier </b> le role <b>  " + this.role.nom + "</b> ?",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Je le souhaite",
            denyButtonText: `Annuler`,
            cancelButtonText: `Annuler`,
          }).then((result) => {
            if (result.isConfirmed) {
              axios.post('update_role/' + this.role.id, {
                nom: this.role.nom,
                sigle: this.role.sigle,
                description: this.role.description
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


    async getroles() {
      try {
        axios.get('role').then((response) => {
          this.roles = response.data;
        }).catch((error) => {
          console.log(error)
        });
      }
      catch (error) {
        console.log(error);
      }
    },

    async enable(data) {
      Swal.fire({
        title: 'Êtes vous sûres ?',
        html: "Souhaitez vous <b>Déactivé</b> le role <b>" + data.nom.charAt(0).toUpperCase() + data.nom.slice(1) + " </b> ?",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Je le souhaite",
        denyButtonText: `Annuler`,
        cancelButtonText: `Annuler`,
      }).then((result) => {
        if (result.isConfirmed) {
          const role = {
            id: data.id,
          };
          axios.post("on_role/" + data.id).then((response) => {
            if (response.data.status === 409) {
              this.toast.error(response.data.alert, { position: 'top-right', duration: 5000 });
            } else if (response.data.status === 200) {
              this.getroles();
              this.toast.success(response.data.alert, { position: 'top-right', duration: 5000 });
            }
          });
        }

      })
    },

    async deletes(data) {
      Swal.fire({
        title: 'Êtes vous sûres ?',
        html: "Souhaitez vous <b>Supprimé</b> le role <b>" + data.nom.charAt(0).toUpperCase() + data.nom.slice(1) + " </b> ?",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Je le souhaite",
        denyButtonText: `Annuler`,
        cancelButtonText: `Annuler`,
      }).then((result) => {
        if (result.isConfirmed) {
          const role = {
            id: data.id,
          };
          axios.post("delete_role/" + data.id).then((response) => {
            if (response.data.status === 409) {
              this.toast.error(response.data.alert, { position: 'top-right', duration: 5000 });
            } else if (response.data.status === 200) {
              this.getroles();
              this.toast.info(response.data.alert, { position: 'top-right', duration: 5000 });
            }
          });
        }

      })
    },

    async desable(data) {
      Swal.fire({
        title: 'Êtes vous sûres ?',
        html: "Souhaitez vous <b>Désactiver</b> le role <b>" + data.nom.charAt(0).toUpperCase() + data.nom.slice(1) + " </b> ? ",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Je le souhaite",
        denyButtonText: `Annuler`,
        cancelButtonText: `Annuler`,
      }).then((result) => {
        if (result.isConfirmed) {
          axios.post("off_role/" + data.id).then((response) => {
            if (response.data.status === 409) {
              this.toast.error(response.data.alert, { position: 'top-right', duration: 5000 });
            } else if (response.data.status === 200) {
              this.getroles();
              this.toast.warning(response.data.alert, { position: 'top-right', duration: 5000 });
            }
          });
        }

      })
    },
  }
}	
</script>
