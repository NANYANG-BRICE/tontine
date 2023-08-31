<template>
  <VCard class="position-relative p-2" elevation="6">
    <VCardText>

      <VRow justify='end' class="mb-2">
        <VDialog v-model="isDialogVisible1" width="500" persistent>
          <!-- Dialog Content -->
          <VCard>
            <DialogCloseBtn variant="text" size="small" @click="isDialogVisible1 = false" />
            <VForm ref="updatePermission" @submit.prevent="updatePermission">
              <VCardText>
                <div class="text-center pb-10 pt-5">
                  <div class="text-h5">
                    <VIcon icon="mdi-crosshairs-account" /> Permissions
                  </div>
                  <span>
                    Modifier les permissions du rôle
                    {{ this.nom_role.charAt(0).toUpperCase() +
                      this.nom_role.slice(1) }}
                  </span>

                  <div class="mt-5">
                    <b class="text-h6">{{ this.association.charAt(0).toUpperCase() + this.association.slice(1) }}</b>
                    <b class="text-h6 mx-2">:</b>
                    <b class="text-h6">{{ this.nom_module.charAt(0).toUpperCase() + this.nom_module.slice(1) }}</b>
                  </div>
                </div>

                <VRow>
                  <VCol cols="6" md="6" class="mt-2 text-h6">
                    <VIcon icon="mdi-visibility-outline" class="ml-8" /> Lecture
                  </VCol>
                  <VCol cols="6" md="6">
                    <VSwitch v-model="lecture" :label="lecture.toString()" true-value="true" false-value="false"
                      class="ml-16" />
                  </VCol>
                </VRow>

                <VRow>
                  <VCol cols="6" md="6" class="mt-2 text-h6">
                    <VIcon icon="mdi-circle-edit-outline" class="ml-8" /> Ecriture
                  </VCol>
                  <VCol cols="6" md="6">
                    <VSwitch v-model="ecriture" :label="ecriture.toString()" true-value="true" false-value="false"
                      class="ml-16" />
                  </VCol>
                </VRow>

                <VRow>
                  <VCol cols="6" md="6" class="mt-2 text-h6">
                    <VIcon icon="mdi-cloud-upload-outline" class="ml-8" /> Modification
                  </VCol>
                  <VCol cols="6" md="6">
                    <VSwitch v-model="modification" :label="modification.toString()" true-value="true" false-value="false"
                      class="ml-16" />
                  </VCol>
                </VRow>

                <VRow>
                  <VCol cols="6" md="6" class="mt-2 text-h6">
                    <VIcon icon="mdi-trash-can-outline" class="ml-8" /> Suppression
                  </VCol>
                  <VCol cols="6" md="6">
                    <VSwitch v-model="suppression" :label="suppression.toString()" true-value="true" false-value="false"
                      class="ml-16" />
                  </VCol>
                </VRow>

                <VRow>
                  <VCol cols="6" md="6" class="mt-2 text-h6">
                    <VIcon icon="mdi-printer-outline" class="ml-8" /> Impression
                  </VCol>
                  <VCol cols="6" md="6">
                    <VSwitch v-model="impression" :label="impression.toString()" true-value="true" false-value="false"
                      class="ml-16" />
                  </VCol>
                </VRow>

                <VRow>
                  <VCol cols="6" md="6" class="mt-2 text-h6">
                    <VIcon icon="mdi-upload-outline" class="ml-8" /> Importation
                  </VCol>
                  <VCol cols="6" md="6">
                    <VSwitch v-model="importation" :label="importation.toString()" true-value="true" false-value="false"
                      class="ml-16" />
                  </VCol>
                </VRow>

                <VRow>
                  <VCol cols="6" md="6" class="mt-2 mb-5 text-h6">
                    <VIcon icon="mdi-visibility-outline" class="ml-8" /> Sauvegarde
                  </VCol>
                  <VCol cols="6" md="6">
                    <VSwitch v-model="sauvegarde" :label="sauvegarde.toString()" true-value="true" false-value="false"
                      class="ml-16" />
                  </VCol>
                </VRow>

              </VCardText>

              <VCardActions>
                <VSpacer />
                <VBtn type="submit" variant="outlined" size="small" color="primary">
                  Modifier <v-icon aria-hidden="false" class="mx-2">mdi-content-save-all-outline</v-icon>
                </VBtn>
                <VBtn variant="outlined" size="small" color="error" @click="isDialogVisible1 = false">
                  Annuler <v-icon aria-hidden="false" class="mx-2">mdi-autorenew</v-icon>
                </VBtn>
                <VSpacer />
              </VCardActions>
            </VForm>
          </VCard>
        </VDialog>

        <VCol cols="12" md="12">
          <VTextField label="Search" v-model="search" clearable append-inner-icon="mdi-magnify" density="compact" />
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
            <VIcon icon='mdi-multiply-outline' color='error' :class="item.raw.read == 'false' ? '' : 'd-none'" />
          </template>

          <!-- ecriture -->
          <template #item.create="{ item }">
            <VIcon icon='mdi-check-multiple' color='success' :class="item.raw.create == 'true' ? '' : 'd-none'" />
            <VIcon icon='mdi-multiply-outline' color='error' :class="item.raw.create == 'false' ? '' : 'd-none'" />
          </template>

          <!-- modification -->
          <template #item.update="{ item }">
            <VIcon icon='mdi-check-multiple' color='success' :class="item.raw.update == 'true' ? '' : 'd-none'" />
            <VIcon icon='mdi-multiply-outline' color='error' :class="item.raw.update == 'false' ? '' : 'd-none'" />
          </template>


          <!-- suppression -->
          <template #item.delete="{ item }">
            <VIcon icon='mdi-check-multiple' color='success' :class="item.raw.delete == 'true' ? '' : 'd-none'" />
            <VIcon icon='mdi-multiply-outline' color='error' :class="item.raw.delete == 'false' ? '' : 'd-none'" />
          </template>

          <!-- Impression -->
          <template #item.print="{ item }">
            <VIcon icon='mdi-check-multiple' color='success' :class="item.raw.print == 'true' ? '' : 'd-none'" />
            <VIcon icon='mdi-multiply-outline' color='error' :class="item.raw.print == 'false' ? '' : 'd-none'" />
          </template>

          <!-- Importation -->
          <template #item.import="{ item }">
            <VIcon icon='mdi-check-multiple' color='success' :class="item.raw.import == 'true' ? '' : 'd-none'" />
            <VIcon icon='mdi-multiply-outline' color='error' :class="item.raw.import == 'false' ? '' : 'd-none'" />
          </template>

          <!-- Backups -->
          <template #item.backup="{ item }">
            <VIcon icon='mdi-check-multiple' color='success' :class="item.raw.backup == 'true' ? '' : 'd-none'" />
            <VIcon icon='mdi-multiply-outline' color='error' :class="item.raw.backup == 'false' ? '' : 'd-none'" />
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

              <IconBtn @click="desablePermission(item.raw)" :class="item.raw.status != 'actif' ? 'd-none' : ''">
                <VTooltip activator="parent" location="top">
                  Désactiver le module {{ item.raw.module }} du rôle {{ item.raw.role }}
                </VTooltip>
                <VIcon icon="mdi-remove-circle-outline" />
              </IconBtn>

              <IconBtn @click="enablePermission(item.raw)" :class="item.raw.status != 'inactif' ? 'd-none' : ''">
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
    const importation = ref('true')
    const sauvegarde = ref('true')
    const impression = ref('true')
    const isDialogVisible = ref(false)
    const isDialogVisible1 = ref(false)
    const groupBy = [{ key: 'association' }]
    const headers = [
      { title: 'ID', sortable: false, key: 'id', },
      { title: 'ROLE', key: 'role', },
      { title: 'MODULE', sortable: false, key: 'module', },
      { title: 'READ', sortable: false, key: 'read', },
      { title: 'WRITE', sortable: false, key: 'create', },
      { title: 'UPDATE', sortable: false, key: 'update', },
      { title: 'DELETE', sortable: false, key: 'delete', },
      { title: 'PRINT', sortable: false, key: 'print', },
      { title: 'IMPORT', sortable: false, key: 'import', },
      { title: 'BACKUP', sortable: false, key: 'backup', },
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
      importation,
      sauvegarde,
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
      association: '',

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
      this.association = data.association;
      this.lecture = data.read;
      this.ecriture = data.create;
      this.modification = data.update;
      this.suppression = data.delete;
      this.impression = data.print;
      this.importation = data.import;
      this.sauvegarde = data.backup;
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
              import: this.importation,
              backup: this.sauvegarde,
            }).then((response) => {
              if (response.data.status === 409) {
                this.isDialogVisible = true;
                this.toast.error(response.data.alert , { position: 'top-right', duration: 5000 });
              } else {
                this.getPermissions();
                this.toast.success(response.data.alert , { position: 'top-right', duration: 5000 });
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
        axios.get('permission').then((response) => {
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
            if (response.data.status === 409) {
              this.toast.error(response.data.alert, { position: 'top-right', duration: 5000 });
            } else if (response.data.status === 200) {
              this.getPermissions();
              this.toast.success(response.data.alert, { position: 'top-right', duration: 5000 });
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
            if (response.data.status === 409) {
              this.toast.error(response.data.alert, { position: 'top-right', duration: 5000 });
            } else if (response.data.status === 200) {
              this.getPermissions();
              this.toast.warning(response.data.alert, { position: 'top-right', duration: 5000 });
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
