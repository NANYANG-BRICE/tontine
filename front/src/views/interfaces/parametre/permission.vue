<template>
  <VCard class="position-relative p-2" elevation="6">
      <VCardText>
          <VRow justify='end' class="mb-2">
              <VDialog v-model="isDialogVisible" width="900" persistent>
                  <!-- Activator -->
                  <template #activator="{ props }">
                      <VBtn size="small" class="mt-4 d-none" v-bind="props" readonly>
                          <VTooltip activator="parent" location="top">
                              Nouveau Permission
                          </VTooltip>
                          Ajouter
                          <VIcon icon="mdi-add-circle-outline" class="ml-1" />
                      </VBtn>
                  </template>

                  <!-- Dialog Content -->
                  <VCard>
                      <DialogCloseBtn variant="text" size="small" @click="isDialogVisible = false" />
                      <VForm ref="newRole" @submit.prevent="newRole">
                          <VCardText>
                              <div class="text-center pb-10 pt-5">
                                  <div class="text-h5">
                                      <VIcon icon="mdi-crosshairs-account" /> Permissions
                                  </div>
                                  <span>Attribuer des permissions à un rôle</span>
                              </div>
                              <VRow>
                                  <VCol cols="12" md="12">
                                      <VAutocomplete v-model="role" label="Selectionnez un rôle" density="compact"
                                          :items="items" />
                                  </VCol>
                              </VRow>
                              <VCol cols="12" md="12">
                              </VCol>
                              <VRow class="text-center mb-1">
                                  <VCol cols="2" md="2"></VCol>

                                  <VCol cols="2" md="2">
                                      <VIcon icon="mdi-visibility-outline" class="mx-1" /> Read
                                  </VCol>

                                  <VCol cols="2" md="2">
                                      <VIcon icon="mdi-circle-edit-outline" class="mx-1" /> Create
                                  </VCol>

                                  <VCol cols="2" md="2">
                                      <VIcon icon="mdi-cloud-upload-outline" class="mx-1" />Update
                                  </VCol>

                                  <VCol cols="2" md="2">
                                      <VIcon icon="mdi-trash-can-outline" class="mx-1" />Delete
                                  </VCol>

                                  <VCol cols="2" md="2">
                                      <VIcon icon="mdi-printer-outline" class="mx-1" />Print
                                  </VCol>
                              </VRow>

                              <VList lines="two" border rounded density>
                                  <template v-for="(module, index) of modules" :key="module.intilute ">
                                      <VListItem>
                                          <VRow>
                                              <VCol cols="2" md="2" class="mt-2">
                                                  {{ module.intilute }} :
                                              </VCol>

                                              <VCol cols="2" md="2">
                                                  <VSwitch v-model="lecture[index]" :label="switch2.toString()"
                                                      true-value="Oui" false-value="Non" />
                                              </VCol>

                                              <VCol cols="2" md="2">
                                                  <VSwitch v-model="ecriture[index]" :label="switch2.toString()"
                                                      true-value="Oui" false-value="Non" />
                                              </VCol>

                                              <VCol cols="2" md="2">
                                                  <VSwitch v-model="modification[index]" :label="switch2.toString()"
                                                      true-value="Oui" false-value="Non" />
                                              </VCol>

                                              <VCol cols="2" md="2">
                                                  <VSwitch v-model="suppression[index]" readonly=""
                                                      :label="switch2.toString()" true-value="Oui" false-value="Non" />
                                              </VCol>

                                              <VCol cols="2" md="2">
                                                  <VSwitch v-model="impression[index]" :label="switch2.toString()"
                                                      true-value="Oui" false-value="Non" />
                                              </VCol>
                                          </VRow>
                                          <VDivider v-if="index !== modules.length - 1" />
                                      </VListItem>
                                  </template>
                              </VList>

                          </VCardText>

                          <VCardActions>
                              <VSpacer />
                              <VBtn type="submit" variant="outlined" size="small" color="primary">
                                  Enregistrer <v-icon aria-hidden="false"
                                      class="mx-2">mdi-content-save-all-outline</v-icon>
                              </VBtn>
                              <VBtn variant="outlined" size="small" color="error" @click="isDialogVisible = false">
                                  Annuler <v-icon aria-hidden="false" class="mx-2">mdi-autorenew</v-icon>
                              </VBtn>
                          </VCardActions>
                      </VForm>
                  </VCard>
              </VDialog>

              <VDialog v-model="isDialogVisible1" width="900" persistent>
                  <!-- Dialog Content -->
                  <VCard>
                      <DialogCloseBtn variant="text" size="small" @click="isDialogVisible1 = false" />
                      <VForm ref="updatePermission" @submit.prevent="updatePermission">
                          <VCardText>
                              <div class="text-center pb-10 pt-5">
                                  <div class="text-h5">
                                      <VIcon icon="mdi-crosshairs-account" /> Permissions
                                  </div>
                                  <span>Modifier les permissions du rôle {{ this.nom_role.charAt(0).toUpperCase() +
                                      this.nom_role.slice(1) }}</span>
                              </div>
                              <VRow class="text-center mb-1">
                                  <VCol cols="2" md="2"></VCol>

                                  <VCol cols="2" md="2">
                                      <VIcon icon="mdi-visibility-outline" class="mx-1" /> Read
                                  </VCol>

                                  <VCol cols="2" md="2">
                                      <VIcon icon="mdi-circle-edit-outline" class="mx-1" /> Create
                                  </VCol>

                                  <VCol cols="2" md="2">
                                      <VIcon icon="mdi-cloud-upload-outline" class="mx-1" />Update
                                  </VCol>

                                  <VCol cols="2" md="2">
                                      <VIcon icon="mdi-trash-can-outline" class="mx-1" />Delete
                                  </VCol>

                                  <VCol cols="2" md="2">
                                      <VIcon icon="mdi-printer-outline" class="mx-1" />Print
                                  </VCol>
                              </VRow>


                              <VRow>
                                  <VCol cols="2" md="2" class="mt-2">
                                      <b>{{ this.nom_module.charAt(0).toUpperCase() + this.nom_module.slice(1) }}</b>
                                  </VCol>

                                  <VCol cols="2" md="2">
                                      <VSwitch v-model="lecture" :label="lecture.toString()" true-value="true"
                                          false-value="false" />
                                  </VCol>

                                  <VCol cols="2" md="2">
                                      <VSwitch v-model="ecriture" :label="ecriture.toString()" true-value="true"
                                          false-value="false" />
                                  </VCol>

                                  <VCol cols="2" md="2">
                                      <VSwitch v-model="modification" :label="modification.toString()" true-value="true"
                                          false-value="false" />
                                  </VCol>

                                  <VCol cols="2" md="2">
                                      <VSwitch v-model="suppression" :label="suppression.toString()" true-value="true"
                                          false-value="false" />
                                  </VCol>

                                  <VCol cols="2" md="2">
                                      <VSwitch v-model="impression" :label="impression.toString()" true-value="true"
                                          false-value="false" />
                                  </VCol>
                              </VRow>

                          </VCardText>

                          <VCardActions>
                              <VSpacer />
                              <VBtn type="submit" variant="outlined" size="small" color="primary">
                                  Enregistrer <v-icon aria-hidden="false"
                                      class="mx-2">mdi-content-save-all-outline</v-icon>
                              </VBtn>
                              <VBtn variant="outlined" size="small" color="error" @click="isDialogVisible1 = false">
                                  Annuler <v-icon aria-hidden="false" class="mx-2">mdi-autorenew</v-icon>
                              </VBtn>
                          </VCardActions>
                      </VForm>
                  </VCard>
              </VDialog>

              <VCol cols="12" md="4">
                  <VTextField label="Search" v-model="search" clearable append-inner-icon="mdi-magnify"
                      density="compact" />
              </VCol>
          </VRow>

          <VRow>
              <v-data-table :headers="headers" :items="permissions" item-value="name" :search="search" :items-per-page="4"
                  :group-by="groupBy">
                  <!-- status -->
                  <template #item.status="{ item }">
                      <VChip :color="resolveStatusVariant(item.raw.status).color" class="font-weight-medium" size="small">
                          {{ resolveStatusVariant(item.raw.status).text }}
                      </VChip>
                  </template>


                  <!-- lecture -->
                  <template #item.read="{ item }">
                      <VIcon icon='mdi-check-multiple' color='success' :class="item.raw.read == 'true' ? '' : 'd-none'" />
                      <VIcon icon='mdi-multiply-outline' color='error'
                          :class="item.raw.read == 'false' ? '' : 'd-none'" />
                  </template>

                  <!-- ecriture -->
                  <template #item.create="{ item }">
                      <VIcon icon='mdi-check-multiple' color='success'
                          :class="item.raw.create == 'true' ? '' : 'd-none'" />
                      <VIcon icon='mdi-multiply-outline' color='error'
                          :class="item.raw.create == 'false' ? '' : 'd-none'" />
                  </template>

                  <!-- modification -->
                  <template #item.update="{ item }">
                      <VIcon icon='mdi-check-multiple' color='success'
                          :class="item.raw.update == 'true' ? '' : 'd-none'" />
                      <VIcon icon='mdi-multiply-outline' color='error'
                          :class="item.raw.update == 'false' ? '' : 'd-none'" />
                  </template>


                  <!-- suppression -->
                  <template #item.delete="{ item }">
                      <VIcon icon='mdi-check-multiple' color='success'
                          :class="item.raw.delete == 'true' ? '' : 'd-none'" />
                      <VIcon icon='mdi-multiply-outline' color='error'
                          :class="item.raw.delete == 'false' ? '' : 'd-none'" />
                  </template>

                  <!-- Impression -->
                  <template #item.print="{ item }">
                      <VIcon icon='mdi-check-multiple' color='success'
                          :class="item.raw.print == 'true' ? '' : 'd-none'" />
                      <VIcon icon='mdi-multiply-outline' color='error'
                          :class="item.raw.print == 'false' ? '' : 'd-none'" />
                  </template>


                  <!-- Actions -->
                  <template #item.actions="{ item }">
                      <div class="d-flex gap-1">
                          <IconBtn @click="geting(item.raw)">
                              <VTooltip activator="parent" location="top">
                                  Modifier le module {{ item.raw.module }} du rôle {{ item.raw.role }}
                              </VTooltip>
                              <VIcon icon="mdi-pencil-outline" />
                          </IconBtn>

                          <IconBtn @click="desablePermission(item.raw)"
                              :class="item.raw.status != 'actif' ? 'd-none' : ''">
                              <VTooltip activator="parent" location="top">
                                  Désactiver le module {{ item.raw.module }} du rôle {{ item.raw.role }}
                              </VTooltip>
                              <VIcon icon="mdi-remove-circle-outline" />
                          </IconBtn>

                          <IconBtn @click="enablePermission(item.raw)"
                              :class="item.raw.status != 'inactif' ? 'd-none' : ''">
                              <VTooltip activator="parent" location="top">
                                  Réactiver le module {{ item.raw.module }} du rôle {{ item.raw.role }}
                              </VTooltip>
                              <VIcon icon="mdi-success-circle-outline" />
                          </IconBtn>

                          <IconBtn @click="deletePermission(item.raw)" class="d-none">
                              <VTooltip activator="parent" location="top">
                                  Supprimer le module {{ item.raw.module }} du rôle {{ item.raw.role }}
                              </VTooltip>
                              <VIcon icon="mdi-delete-outline" />
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
      const switch2 = ref('Oui ?')
      const lecture = ref('true')
      const ecriture = ref('true')
      const modification = ref('true')
      const suppression = ref('true')
      const impression = ref('true')
      const isDialogVisible = ref(false)
      const isDialogVisible1 = ref(false)
      const groupBy = [{ key: 'role' }]
      const headers = [
          { title: 'ID', sortable: false, key: 'id', },
          { title: 'ROLE', key: 'role', },
          { title: 'MODULE', sortable: false, key: 'module', },
          { title: 'READ', sortable: false, key: 'read', },
          { title: 'WRITE', sortable: false, key: 'create', },
          { title: 'UPDATE', sortable: false, key: 'update', },
          { title: 'DELETE', sortable: false, key: 'delete', },
          { title: 'PRINT', sortable: false, key: 'print', },
          { title: 'STATUT', key: 'status', },
          { title: 'ACTIONS', sortable: false, key: 'actions', },
      ]
      const resolveStatusVariant = status => {
          if (status === 'actif') {

              return {
                  color: 'primary',
                  text: 'Actif',
              }
          }
          else {
              return {
                  color: 'error',
                  text: 'Inactif',
              }
          }
      }

      return {
          toast,
          search,
          switch2,
          groupBy,
          headers,
          lecture,
          ecriture,
          modification,
          suppression,
          impression,
          isDialogVisible,
          isDialogVisible1,
          resolveStatusVariant,
      }
  },

  data() {
      return {
          role: '',
          actif: false,
          inactif: false,
          permissions: [],
          id_permission: '',
          items: [],
          permissions_id: '',
          nom_role: '',
          nom_module: '',

          rules: {
              required: value => !!value || 'Désolé mais ce champ est obligatoire.',
              min: value => value.length >= 5 || 'Vous devez entré au moins 05 caractères',
          },
      }
  },

  created() {
      this.getPermissions();
  },

  methods: {
      async geting(data) {
          this.isDialogVisible1 = true;
          this.id_permission = data.id;
          this.nom_role = data.role;
          this.nom_module = data.module;
          this.lecture = data.read;
          this.ecriture = data.create;
          this.modification = data.update;
          this.suppression = data.delete;
          this.impression = data.print;
          console.log(data)
      },

      async updatePermission() {
          try {
              this.isDialogVisible1 = false
              Swal.fire({
                  title: 'Êtes vous sûres ?',
                  html: "Souhaitez vous <b>Modifier</b> les accréditations du module <b>" + this.nom_module.charAt(0).toUpperCase() + this.nom_module.slice(1) + " </b> pour le rôle <b>" + this.nom_role.charAt(0).toUpperCase() + this.nom_role.slice(1) + " </b> ?",
                  showDenyButton: true,
                  showCancelButton: false,
                  confirmButtonText: "Je le souhaite",
                  denyButtonText: `Annuler`,
                  cancelButtonText: `Annuler`,
              }).then((result) => {
                  if (result.isConfirmed) {
                      axios.post('update_permission/' + this.id_permission, {
                          read: this.lecture,
                          create: this.ecriture,
                          update: this.modification,
                          delete: this.suppression,
                          print: this.impression,
                      }).then((response) => {
                          if (response.status === 409) {
                              this.isDialogVisible = true;
                              this.toast.error('Les accréditations n\'ont pas été approtées', { position: 'top-right', duration: 5000 });
                          } else {
                              this.getPermissions();
                              this.toast.success('Les accréditations ont bien été approtées', { position: 'top-right', duration: 5000 });
                          }
                      }, (error) => {
                          console.log(error);
                      });
                  }

              })
          }
          catch (error) {
              console.log(error);
          }
      },

      async getPermissions() {
          try {
              axios.get('permissions').then((response) => {
                  this.permissions = response.data;
              }).catch((error) => {
                  console.log(error)
              });
          }
          catch (error) {
              console.log(error);
          }
      },

      async enablePermission(data) {
          Swal.fire({
              title: 'Êtes vous sûres ?',
              html: "Souhaitez vous <b>Réactivé</b> la permission du module <b>" + data.module.charAt(0).toUpperCase() + data.module.slice(1) + " </b> pour le rôle <b>" + data.role.charAt(0).toUpperCase() + data.role.slice(1) + " </b> ?",
              showDenyButton: true,
              showCancelButton: false,
              confirmButtonText: "Je le souhaite",
              denyButtonText: `Annuler`,
              cancelButtonText: `Annuler`,
          }).then((result) => {
              if (result.isConfirmed) {
                  axios.post("on_permission/" + data.id).then((response) => {
                      if (response.status === 409) {
                          this.toast.error('Impossible de réactiver cette permission', { position: 'top-right', duration: 5000 });
                      } else if (response.status === 200) {
                          this.getPermissions();
                          this.toast.success('La permission a bien été réactivée', { position: 'top-right', duration: 5000 });
                      }
                  });
              }

          })
      },

      async desablePermission(data) {
          Swal.fire({
              title: 'Êtes vous sûres ?',
              html: "Souhaitez vous <b>Désactivé</b> la permission du module <b>" + data.module.charAt(0).toUpperCase() + data.module.slice(1) + " </b> pour le rôle <b>" + data.role.charAt(0).toUpperCase() + data.role.slice(1) + " </b> ?",
              showDenyButton: true,
              showCancelButton: false,
              confirmButtonText: "Je le souhaite",
              denyButtonText: `Annuler`,
              cancelButtonText: `Annuler`,
          }).then((result) => {
              if (result.isConfirmed) {
                  axios.post("off_permission/" + data.id).then((response) => {
                      if (response.status === 409) {
                          this.toast.error('Impossible de désactiver cette permission', { position: 'top-right', duration: 5000 });
                      } else if (response.status === 200) {
                          this.getPermissions();
                          this.toast.success('La permission a bien été désactivée', { position: 'top-right', duration: 5000 });
                      }
                  });
              }
          })
      },

      async deletePermission(data) {
          Swal.fire({
              title: 'Êtes vous sûres ?',
              html: "Souhaitez vous <b>Supprimé</b> la permission du module <b>" + data.module.charAt(0).toUpperCase() + data.module.slice(1) + " </b> pour le rôle <b>" + data.role.charAt(0).toUpperCase() + data.role.slice(1) + " </b> ? Cette action est irréversible et n'engage que vous",
              showDenyButton: true,
              showCancelButton: false,
              confirmButtonText: "Je le souhaite",
              denyButtonText: `Annuler`,
              cancelButtonText: `Annuler`,
          }).then((result) => {
              if (result.isConfirmed) {
                  axios.post("delete_permission/" + data.id).then((response) => {
                      if (response.status === 409) {
                          this.toast.error('Impossible de désactiver cette permission', { position: 'top-right', duration: 5000 });
                      } else if (response.status === 200) {
                          this.getPermissions();
                          this.toast.success('La permission a bien été désactivée', { position: 'top-right', duration: 5000 });
                      }
                  });
              }
          })
      }
  }
}	
</script>
