<template>
  <VCard>
    <VCardText>
      <!-- 👉 Stepper -->
    </VCardText>


    <VCardText>
      <!-- 👉 stepper content -->
      <VForm>
        <VWindow v-model="currentStep" class="disable-tab-transition">
          <VWindowItem>
            <VRow>
              <VCol cols="12" class="text-center">
                <h6 class="text-sm font-weight-medium">
                  Informations Personnelles
                </h6>
                <p class="text-xs mb-0">
                  Renseignez ou modifiez vos informations personnelles
                </p>
              </VCol>

              <VCol cols="12" md="4">
                <VTextField density="compact" prepend-inner-icon="mdi-account-settings-outline"
                  placeholder="Matricule...." label="Matricule" v-model="formData.matricule" readonly />
              </VCol>

              <VCol cols="12" md="4">
                <VTextField density="compact" prepend-inner-icon="mdi-shield-user-outline" placeholder="Type Compte...."
                  label="Type Compte" v-model="formData.type_compte" readonly />
              </VCol>

              <VCol cols="12" md="4">
                <VTextField density="compact" prepend-inner-icon="mdi-house-circle-outline"
                  placeholder="Association...." label="Association" v-model="formData.association" readonly />
              </VCol>

              <VCol cols="12" md="4">
                <VTextField density="compact" prepend-inner-icon="mdi-account-outline" v-model="formData.nom"
                  placeholder="Noms...." label="Noms" />
              </VCol>

              <VCol cols="12" md="4">
                <VTextField density="compact" prepend-inner-icon="mdi-account-outline" v-model="formData.prenom"
                  placeholder="Pénoms...." label="Prénoms" />
              </VCol>

              <VCol cols="12" md="4">
                <VTextField density="compact" v-model="formData.status" prepend-inner-icon="mdi-account-online-outline"
                  placeholder="Status...." label="Status" readonly />
              </VCol>

              <VCol cols="12" md="4">
                <VTextField density="compact" prepend-inner-icon="mdi-email-outline" v-model="formData.email"
                  placeholder="Email...." label="Email" />
              </VCol>

              <VCol cols="12" md="4">
                <VTextField density="compact" prepend-inner-icon="mdi-phone-classic" v-model="formData.telephone"
                  placeholder="Téléphone...." label="Téléphone" />
              </VCol>

              <VCol cols="12" md="4">
                <VSelect :items="['masculin', 'feminin']" v-model="formData.sexe"
                  prepend-inner-icon="mdi-gender-male-female" label="Sexe" density="compact" />
              </VCol>

              <VCol cols="12" md="4">
                <VTextField v-model="formData.password1" label="Mot de Passe" density="compact"
                  placeholder="Enter Password" :type="isPasswordVisible ? 'text' : 'password'"
                  :append-inner-icon="isPasswordVisible ? 'mdi-eye-outline' : 'mdi-eye-off-outline'"
                  @click:append-inner="isPasswordVisible = !isPasswordVisible" />
              </VCol>

              <VCol cols="12" md="4">
                <VTextField v-model="formData.password2" label="Nouveau Mot de passe" density="compact"
                  placeholder="Enter Password" :type="isPasswordVisible ? 'text' : 'password'"
                  :append-inner-icon="isPasswordVisible ? 'mdi-eye-outline' : 'mdi-eye-off-outline'"
                  @click:append-inner="isPasswordVisible = !isPasswordVisible" />
              </VCol>

              <VCol cols="12" md="4">
                <VTextField v-model="formData.c_password" label="Confirmez le mot de Passe" density="compact"
                  placeholder="Enter Confirm Password" :type="isCPasswordVisible ? 'text' : 'password'"
                  :append-inner-icon="isCPasswordVisible ? 'mdi-eye-outline' : 'mdi-eye-off-outline'"
                  @click:append-inner="isCPasswordVisible = !isCPasswordVisible" />
              </VCol>
            </VRow>
          </VWindowItem>
        </VWindow>

        <div class="d-flex justify-sm-space-between gap-4 flex-wrap justify-center mt-6">
          <VSpacer />
          <VBtn type="submit" variant="outlined" size="small" color="primary">
            Modifier <v-icon aria-hidden="false" class="mx-2">mdi-content-save-all-outline</v-icon>
          </VBtn>

          <VBtn variant="outlined" size="small" color="error" @click="isDialogVisible1 = false">
            Annuler <v-icon aria-hidden="false" class="mx-2">mdi-autorenew</v-icon>
          </VBtn>
        </div>
      </VForm>
    </VCardText>
  </VCard>
</template>

<script>
  export default {
    setup() {

      const currentStep = ref(0)
      const isPasswordVisible = ref(false)
      const isCPasswordVisible = ref(false)

      return {
        currentStep,
        isPasswordVisible,
        isCPasswordVisible,
      }
    },

    data() {
      return {
        formData: {
          matricule: '',
          type_compte: '',
          password1: '',
          password2: '',
          c_password: '',
          association: '',
          nom: '',
          prenom: '',
          status: '',
          email: '',
          telephone: '',
          sexe: '',
        }
      }
    },


    created(){
      this.getData();
    },

    methods: {
      async getData(){

      }
    }

  }
</script>
