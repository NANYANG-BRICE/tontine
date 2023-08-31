<template>
  <VCard>
    <VCardText>

      <VRow justify='end' class="mb-2">

        <VCol cols="12" md="2">
          <VDialog v-model="ajouter" persistent class="v-dialog-md">
            <!-- Dialog Activator -->
            <template #activator="{ props }">
              <VBtn color="primary" type="submit" size="small" class="mx-2 mt-1" v-bind="props">
                <VIcon icon="mdi-add-circle-outline" class="d-sm-none" />
                <span class="d-none d-sm-block">
                  Ajouter <v-icon aria-hidden="false" class="mx-1">mdi-add-circle-outline</v-icon>
                </span>
              </VBtn>
            </template>

            <!-- Dialog Content -->
            <VCard>
              <VCardText>
                <VForm ref="new_association" @submit.prevent="new_association">
                  <VWindow v-model="currentStep" class="disable-tab-transition">
                    <VWindowItem>
                      <VRow>
                        <VCol cols="12" class="text-center mt-5 mb-5">
                          <h6 class="text-sm font-weight-medium text-h6">
                            Infos Principales
                          </h6>
                          <p class="text-xs mb-0">
                            Renseignez ou modifiez les Informations
                          </p>
                        </VCol>

                        <VCol cols="12" md="4">
                          <VTextField v-model="association.nom" placeholder="Noms Association...."
                            prepend-inner-icon="mdi-home-circle-outline" label="Noms" density="compact" clearable
                            autocomplete="off" :rules="[rules.required, rules.min]" />
                        </VCol>

                        <VCol cols="12" md="4">
                          <VTextField v-model="association.raison_sociale" placeholder="Raison Sociale...."
                            prepend-inner-icon="mdi-home-circle-outline" label="Raison Sociale" density="compact"
                            clearable autocomplete="off" :rules="[rules.required, rules.min]" />
                        </VCol>

                        <VCol cols="12" md="4">
                          <VTextField v-model="association.sigle" placeholder="Sigle Association...." label="Sigle"
                            prepend-inner-icon="mdi-home-circle" density="compact" clearable autocomplete="off"
                            :rules="[rules.required, rules.min]" />
                        </VCol>

                        <VCol cols="12" md="4">
                          <VTextField v-model="association.slogant" placeholder="Slogan Association..."
                            prepend-inner-icon="mdi-text-recognition" label="Slogan" density="compact"
                            :rules="[rules.required, rules.min]" />
                        </VCol>

                        <VCol cols="12" md="4">
                          <VTextField v-model="association.telephone" placeholder="Télephone Association...."
                            prepend-inner-icon="mdi-phone-classic" label="Télephone" density="compact" clearable
                            :rules="[rules.required, rules.min]" />
                        </VCol>

                        <VCol cols="12" md="4">
                          <VTextField v-model="association.email" placeholder="Email Association..." label="Email"
                            prepend-inner-icon="mdi-email-heart-outline" density="compact"
                            :rules="[rules.required, rules.email]" />
                        </VCol>

                        <VCol cols="12" md="12">
                          <VTextField v-model="association.filigramme" placeholder="Filigramme Association...."
                            prepend-inner-icon="mdi-text-box-edit-outline" label="Filigramme" density="compact" />
                        </VCol>
                      </VRow>
                    </VWindowItem>

                    <VWindowItem>
                      <VRow>
                        <VCol cols="12" class="text-center mt-5 mb-5">
                          <h6 class="text-sm font-weight-medium text-h6">
                            Identité Sociale
                          </h6>
                          <p class="text-xs mb-0">
                            Mettez à jour votre identité sociale
                          </p>
                        </VCol>

                        <VCol cols="12" md="6">
                          <VTextField v-model="association.facebook" prepend-inner-icon="mdi-facebook" density="compact"
                            placeholder="https://facebook.com/" label="Facebook" :rules="[rules.required, rules.url]" />
                        </VCol>

                        <VCol cols="12" md="6">
                          <VTextField v-model="association.twitter" placeholder="https://twitter.com/"
                            prepend-inner-icon="mdi-twitter" density="compact" label="Twitter" clearable
                            :rules="[rules.required, rules.url]" />
                        </VCol>

                        <VCol cols="12" md="6">
                          <VTextField v-model="association.linkedin" prepend-inner-icon="mdi-linkedin" density="compact"
                            placeholder="https://linkedin.com/" label="LinkedIn" :rules="[rules.required, rules.url]" />
                        </VCol>

                        <VCol cols="12" md="6">
                          <VTextField v-model="association.whatsapp" prepend-inner-icon="mdi-whatsapp" density="compact"
                            placeholder="237657807309" label="Whatsapp" :rules="[rules.required, rules.url]" />
                        </VCol>

                        <VCol cols="12" md="12">
                          <VTextField v-model="association.site_web" prepend-inner-icon="mdi-web" density="compact"
                            placeholder="https://tontinar.com/" label="Site Web" :rules="[rules.required, rules.url]" />
                        </VCol>
                      </VRow>
                    </VWindowItem>

                    <VWindowItem>
                      <VRow>
                        <VCol cols="12" class="text-center mt-5 mb-5">
                          <h6 class="text-sm font-weight-medium text-h6">
                            Infos Supplémentaires
                          </h6>
                          <p class="text-xs mb-0">
                            Renseignez ou modifiez ces Informations
                          </p>
                        </VCol>

                        <VCol cols="12" md="6">
                          <VTextField v-model="association.entete_sms" placeholder="Tontinars...."
                            prepend-inner-icon="mdi-account" density="compact" label="Entête SMS" clearable
                            :rules="[rules.required, rules.max]" />
                        </VCol>

                        <VCol cols="12" md="6">
                          <VFileInput v-model="association.logo" label="Logo" accept="image/*" clearable prepend-icon=""
                            prepend-inner-icon="mdi-file-image" density="compact" />
                        </VCol>

                        <VCol cols="12" md="3">
                          <VTextField v-model="association.solde_email" placeholder="0"
                            prepend-inner-icon="mdi-archive-outline" density="compact" label="Solde Email" readonly
                            :rules="[rules.required]" />
                        </VCol>

                        <VCol cols="12" md="3">
                          <VTextField v-model="association.solde_whatsapp" placeholder="0"
                            prepend-inner-icon="mdi-archive-outline" density="compact" label="Solde Whatsapp" readonly
                            :rules="[rules.required]" />
                        </VCol>

                        <VCol cols="12" md="3">
                          <VTextField v-model="association.solde_telegram" placeholder="0"
                            prepend-inner-icon="mdi-archive-outline" density="compact" label="Solde Telegram" readonly
                            :rules="[rules.required]" />
                        </VCol>

                        <VCol cols="12" md="3">
                          <VTextField v-model="association.solde_sms" placeholder="0"
                            prepend-inner-icon="mdi-archive-outline" density="compact" label="Solde SMS" readonly
                            :rules="[rules.required]" />
                        </VCol>



                        <VCol cols="12" md="6">
                          <VTextField v-model="association.taux_annuel" placeholder="0.00"
                            prepend-inner-icon="mdi-percent-outline" density="compact" label="Taux annuel" clearable
                            :rules="[rules.required]" />
                        </VCol>

                        <VCol cols="12" md="3">
                          <VTextField v-model="association.montant_inscription_nouveau" placeholder="0"
                            prepend-inner-icon="mdi-wallet-outline" density="compact" label="Inscription Nouveau"
                            clearable :rules="[rules.required]" />
                        </VCol>

                        <VCol cols="12" md="3">
                          <VTextField v-model="association.montant_inscription_ancien" placeholder="0"
                            prepend-inner-icon="mdi-wallet-outline" density="compact" label="Inscription Ancien"
                            clearable :rules="[rules.required]" />
                        </VCol>


                        <VCol cols="12" md="12">
                          <VTextarea v-model="association.description" placeholder="Description"
                            prepend-inner-icon="mdi-comment-outline" density="compact" label="Description...." clearable
                            :rules="[rules.required, rules.min]" />
                        </VCol>
                      </VRow>
                    </VWindowItem>
                  </VWindow>


                  <div class="d-flex justify-sm-space-between gap-4 flex-wrap justify-center mt-8">
                    <VBtn :color="currentStep === 0 ? 'secondary' : 'default'" variant="outlined"
                      :disabled="currentStep === 0" @click="currentStep--">
                      <VIcon icon="mdi-arrow-left" class="d-sm-none" />
                      <span class="d-none d-sm-block">
                        Précédent
                        <VIcon icon="mdi-arrow-left" end class="flip-in-rtl" />
                      </span>
                    </VBtn>

                    <VBtn v-if="iconsSteps.length - 1 === currentStep" color="primary" type="submit">
                      <VIcon icon="mdi-content-save-all-outline" class="d-sm-none" />
                      <span class="d-none d-sm-block">
                        Enregistrer <v-icon aria-hidden="false" class="mx-1">mdi-content-save-all-outline</v-icon>
                      </span>
                    </VBtn>

                    <VBtn v-else @click="currentStep++">
                      <VIcon icon="mdi-arrow-right" class="d-sm-none" />
                      <span class="d-none d-sm-block">
                        Continuer
                        <VIcon icon="mdi-arrow-right" end class="flip-in-rtl" />
                      </span>
                    </VBtn>
                  </div>
                </VForm>
              </VCardText>
              <!-- 👉 stepper content -->
            </VCard>
          </VDialog>


          <VDialog v-model="modifier" persistent class="v-dialog-md">
            <!-- Dialog Content -->
            <VCard>
              <VCardText>
                <VForm ref="update_association" @submit.prevent="update_association">
                  <VWindow v-model="currentStep" class="disable-tab-transition">
                    <VWindowItem>
                      <VRow>
                        <VCol cols="12" class="text-center mt-5 mb-5">
                          <h6 class="text-sm font-weight-medium text-h6">
                            Infos Principales
                          </h6>
                          <p class="text-xs mb-0">
                            Renseignez ou modifiez les Informations
                          </p>
                        </VCol>

                        <VCol cols="12" md="4">
                          <VTextField v-model="association.nom" placeholder="Noms Association...."
                            prepend-inner-icon="mdi-home-circle-outline" label="Noms" density="compact" clearable
                            autocomplete="off" :rules="[rules.required, rules.min]" />
                        </VCol>

                        <VCol cols="12" md="4">
                          <VTextField v-model="association.raison_sociale" placeholder="Raison Sociale...."
                            prepend-inner-icon="mdi-home-circle-outline" label="Raison Sociale" density="compact"
                            clearable autocomplete="off" :rules="[rules.required, rules.min]" />
                        </VCol>

                        <VCol cols="12" md="4">
                          <VTextField v-model="association.sigle" placeholder="Sigle Association...." label="Sigle"
                            prepend-inner-icon="mdi-home-circle" density="compact" clearable autocomplete="off"
                            :rules="[rules.required, rules.min]" />
                        </VCol>

                        <VCol cols="12" md="4">
                          <VTextField v-model="association.slogant" placeholder="Slogan Association..."
                            prepend-inner-icon="mdi-text-recognition" label="Slogan" density="compact"
                            :rules="[rules.required, rules.min]" />
                        </VCol>

                        <VCol cols="12" md="4">
                          <VTextField v-model="association.telephone" placeholder="Télephone Association...."
                            prepend-inner-icon="mdi-phone-classic" label="Télephone" density="compact" clearable
                            :rules="[rules.required, rules.min]" />
                        </VCol>

                        <VCol cols="12" md="4">
                          <VTextField v-model="association.email" placeholder="Email Association..." label="Email"
                            prepend-inner-icon="mdi-email-heart-outline" density="compact"
                            :rules="[rules.required, rules.email]" />
                        </VCol>

                        <VCol cols="12" md="12">
                          <VTextField v-model="association.filigramme" placeholder="Filigramme Association...."
                            prepend-inner-icon="mdi-text-box-edit-outline" label="Filigramme" density="compact" />
                        </VCol>
                      </VRow>
                    </VWindowItem>

                    <VWindowItem>
                      <VRow>
                        <VCol cols="12" class="text-center mt-5 mb-5">
                          <h6 class="text-sm font-weight-medium text-h6">
                            Identité Sociale
                          </h6>
                          <p class="text-xs mb-0">
                            Mettez à jour votre identité sociale
                          </p>
                        </VCol>

                        <VCol cols="12" md="6">
                          <VTextField v-model="association.facebook" prepend-inner-icon="mdi-facebook" density="compact"
                            placeholder="https://facebook.com/" label="Facebook" :rules="[rules.required, rules.url]" />
                        </VCol>

                        <VCol cols="12" md="6">
                          <VTextField v-model="association.twitter" placeholder="https://twitter.com/"
                            prepend-inner-icon="mdi-twitter" density="compact" label="Twitter" clearable
                            :rules="[rules.required, rules.url]" />
                        </VCol>

                        <VCol cols="12" md="6">
                          <VTextField v-model="association.linkedin" prepend-inner-icon="mdi-linkedin" density="compact"
                            placeholder="https://linkedin.com/" label="LinkedIn" :rules="[rules.required, rules.url]" />
                        </VCol>

                        <VCol cols="12" md="6">
                          <VTextField v-model="association.whatsapp" prepend-inner-icon="mdi-whatsapp" density="compact"
                            placeholder="237657807309" label="Whatsapp" :rules="[rules.required, rules.url]" />
                        </VCol>

                        <VCol cols="12" md="12">
                          <VTextField v-model="association.site_web" prepend-inner-icon="mdi-web" density="compact"
                            placeholder="https://tontinar.com/" label="Site Web" :rules="[rules.required, rules.url]" />
                        </VCol>
                      </VRow>
                    </VWindowItem>

                    <VWindowItem>
                      <VRow>
                        <VCol cols="12" class="text-center mt-5 mb-5">
                          <h6 class="text-sm font-weight-medium text-h6">
                            Infos Supplémentaires
                          </h6>
                          <p class="text-xs mb-0">
                            Renseignez ou modifiez ces Informations
                          </p>
                        </VCol>

                        <VCol cols="12" md="6">
                          <VTextField v-model="association.entete_sms" placeholder="Tontinars...."
                            prepend-inner-icon="mdi-account" density="compact" label="Entête SMS" clearable
                            :rules="[rules.required, rules.max]" />
                        </VCol>

                        <VCol cols="12" md="6">
                          <VFileInput v-model="association.logo" label="Logo" accept="image/*" clearable prepend-icon=""
                            prepend-inner-icon="mdi-file-image" density="compact" />
                        </VCol>

                        <VCol cols="12" md="3">
                          <VTextField v-model="association.solde_email" placeholder="0"
                            prepend-inner-icon="mdi-archive-outline" density="compact" label="Solde Email" readonly
                            :rules="[rules.required]" />
                        </VCol>

                        <VCol cols="12" md="3">
                          <VTextField v-model="association.solde_whatsapp" placeholder="0"
                            prepend-inner-icon="mdi-archive-outline" density="compact" label="Solde Whatsapp" readonly
                            :rules="[rules.required]" />
                        </VCol>

                        <VCol cols="12" md="3">
                          <VTextField v-model="association.solde_telegram" placeholder="0"
                            prepend-inner-icon="mdi-archive-outline" density="compact" label="Solde Telegram" readonly
                            :rules="[rules.required]" />
                        </VCol>

                        <VCol cols="12" md="3">
                          <VTextField v-model="association.solde_sms" placeholder="0"
                            prepend-inner-icon="mdi-archive-outline" density="compact" label="Solde SMS" readonly
                            :rules="[rules.required]" />
                        </VCol>



                        <VCol cols="12" md="6">
                          <VTextField v-model="association.taux_annuel" placeholder="0.00"
                            prepend-inner-icon="mdi-percent-outline" density="compact" label="Taux annuel" clearable
                            :rules="[rules.required]" />
                        </VCol>

                        <VCol cols="12" md="3">
                          <VTextField v-model="association.montant_inscription_nouveau" placeholder="0"
                            prepend-inner-icon="mdi-wallet-outline" density="compact" label="Inscription Nouveau"
                            clearable :rules="[rules.required]" />
                        </VCol>

                        <VCol cols="12" md="3">
                          <VTextField v-model="association.montant_inscription_ancien" placeholder="0"
                            prepend-inner-icon="mdi-wallet-outline" density="compact" label="Inscription Ancien"
                            clearable :rules="[rules.required]" />
                        </VCol>


                        <VCol cols="12" md="12">
                          <VTextarea v-model="association.description" placeholder="Description"
                            prepend-inner-icon="mdi-comment-outline" density="compact" label="Description...." clearable
                            :rules="[rules.required, rules.min]" />
                        </VCol>
                      </VRow>
                    </VWindowItem>
                  </VWindow>

                  <div class="d-flex justify-sm-space-between gap-4 flex-wrap justify-center mt-8">
                    <VBtn :color="currentStep === 0 ? 'secondary' : 'default'" variant="outlined"
                      :disabled="currentStep === 0" @click="currentStep--">
                      <VIcon icon="mdi-arrow-left" class="d-sm-none" />
                      <span class="d-none d-sm-block">
                        <VIcon icon="mdi-arrow-left" end class="flip-in-rtl" />
                        Précédent
                      </span>
                    </VBtn>

                    <VSpacer />

                    <VBtn v-if="iconsSteps.length - 1 === currentStep" color="primary">
                      <VIcon icon="mdi-content-save-all-outline" class="d-sm-none" />
                      <span class="d-none d-sm-block">
                        Modifier <v-icon aria-hidden="false" class="mx-1">mdi-content-save-all-outline</v-icon>
                      </span>
                    </VBtn>

                    <VBtn v-if="iconsSteps.length - 1 === currentStep" color="error" @click="reset">
                      <VIcon icon="mdi-close-outline" class="d-sm-none" />
                      <span class="d-none d-sm-block">
                        Annuler <v-icon aria-hidden="false" class="mx-1">mdi-close-outline</v-icon>
                      </span>
                    </VBtn>

                    <VBtn v-else @click="currentStep++">
                      <VIcon icon="mdi-arrow-right" class="d-sm-none" />
                      <span class="d-none d-sm-block">
                        Continuer
                        <VIcon icon="mdi-arrow-right" end class="flip-in-rtl" />
                      </span>
                    </VBtn>
                  </div>
                </VForm>
              </VCardText>
            </VCard>
          </VDialog>


          <VDialog v-model="consulter" persistent class="v-dialog-md">
            <!-- Dialog Content -->
            <VCard>

              <VCardText>
                <VForm>
                  <VWindow v-model="currentStep" class="disable-tab-transition">
                    <VWindowItem>
                      <VRow>
                        <VCol cols="12" class="text-center mt-5 mb-5">
                          <h6 class="text-sm font-weight-medium text-h6">
                            Infos Principales
                          </h6>
                          <p class="text-xs mb-0">
                            Renseignez ou modifiez les Informations
                          </p>
                        </VCol>

                        <VCol cols="12" md="4">
                          <VTextField v-model="association.nom" placeholder="Noms Association...."
                            prepend-inner-icon="mdi-home-circle-outline" label="Noms" density="compact"
                            autocomplete="off" readonly />
                        </VCol>

                        <VCol cols="12" md="4">
                          <VTextField v-model="association.raison_sociale" placeholder="Raison Sociale...."
                            prepend-inner-icon="mdi-home-circle-outline" label="Raison Sociale" density="compact"
                            readonly autocomplete="off" />
                        </VCol>

                        <VCol cols="12" md="4">
                          <VTextField v-model="association.sigle" placeholder="Sigle Association...." label="Sigle"
                            prepend-inner-icon="mdi-home-circle" density="compact" readonly autocomplete="off" />
                        </VCol>

                        <VCol cols="12" md="4">
                          <VTextField v-model="association.slogant" placeholder="Slogan Association..."
                            prepend-inner-icon="mdi-text-recognition" label="Slogan" density="compact" />
                        </VCol>

                        <VCol cols="12" md="4">
                          <VTextField v-model="association.telephone" placeholder="Télephone Association...."
                            prepend-inner-icon="mdi-phone-classic" label="Télephone" density="compact" readonly />
                        </VCol>

                        <VCol cols="12" md="4">
                          <VTextField v-model="association.email" placeholder="Email Association..." readonly
                            label="Email" prepend-inner-icon="mdi-email-heart-outline" density="compact" />
                        </VCol>

                        <VCol cols="12" md="12">
                          <VTextField v-model="association.filigramme" placeholder="Filigramme Association...."
                            prepend-inner-icon="mdi-text-box-edit-outline" readonly label="Filigramme"
                            density="compact" />
                        </VCol>
                      </VRow>
                    </VWindowItem>

                    <VWindowItem>
                      <VRow>
                        <VCol cols="12" class="text-center mt-5 mb-5">
                          <h6 class="text-sm font-weight-medium text-h6">
                            Identité Sociale
                          </h6>
                          <p class="text-xs mb-0">
                            Mettez à jour votre identité sociale
                          </p>
                        </VCol>

                        <VCol cols="12" md="6">
                          <VTextField v-model="association.facebook" prepend-inner-icon="mdi-facebook" density="compact"
                            placeholder="https://facebook.com/" readonly label="Facebook" />
                        </VCol>

                        <VCol cols="12" md="6">
                          <VTextField v-model="association.twitter" placeholder="https://twitter.com/"
                            prepend-inner-icon="mdi-twitter" density="compact" readonly label="Twitter" />
                        </VCol>

                        <VCol cols="12" md="6">
                          <VTextField v-model="association.linkedin" prepend-inner-icon="mdi-linkedin" density="compact"
                            placeholder="https://linkedin.com/" readonly label="LinkedIn" />
                        </VCol>

                        <VCol cols="12" md="6">
                          <VTextField v-model="association.whatsapp" prepend-inner-icon="mdi-linkedin" density="compact"
                            placeholder="237657807309" readonly label="Whatsapp" />
                        </VCol>

                        <VCol cols="12" md="12">
                          <VTextField v-model="association.site_web" prepend-inner-icon="mdi-web" density="compact"
                            placeholder="https://tontinar.com/" readonly label="Site Web" />
                        </VCol>
                      </VRow>
                    </VWindowItem>

                    <VWindowItem>
                      <VRow>
                        <VCol cols="12" class="text-center mt-5 mb-5">
                          <h6 class="text-sm font-weight-medium text-h6">
                            Infos Supplémentaires
                          </h6>
                          <p class="text-xs mb-0">
                            Rneseignez ou modifiez ces Informations
                          </p>
                        </VCol>

                        <VCol cols="12" md="12">
                          <VTextField v-model="association.entete_sms" placeholder="Tontinars...."
                            prepend-inner-icon="mdi-account" density="compact" label="Entête SMS" readonly />
                        </VCol>

                        <VCol cols="12" md="6" class="d-none">
                          <VFileInput v-model="association.logo" label="Logo" accept="image/*" readonly prepend-icon=""
                            prepend-inner-icon="mdi-file-image" density="compact" />
                        </VCol>

                        <VCol cols="12" md="3">
                          <VTextField v-model="association.solde_email" placeholder="0"
                            prepend-inner-icon="mdi-archive-outline" density="compact" label="Solde Email" readonly />
                        </VCol>

                        <VCol cols="12" md="3">
                          <VTextField v-model="association.solde_whatsapp" placeholder="0"
                            prepend-inner-icon="mdi-archive-outline" density="compact" label="Solde Whatsapp"
                            readonly />
                        </VCol>

                        <VCol cols="12" md="3">
                          <VTextField v-model="association.solde_telegram" placeholder="0"
                            prepend-inner-icon="mdi-archive-outline" density="compact" label="Solde Telegram"
                            readonly />
                        </VCol>

                        <VCol cols="12" md="3">
                          <VTextField v-model="association.solde_sms" placeholder="0"
                            prepend-inner-icon="mdi-archive-outline" density="compact" label="Solde SMS" readonly />
                        </VCol>



                        <VCol cols="12" md="6">
                          <VTextField v-model="association.taux_annuel" placeholder="0.00"
                            prepend-inner-icon="mdi-percent-outline" density="compact" label="Taux annuel" readonly />
                        </VCol>

                        <VCol cols="12" md="3">
                          <VTextField v-model="association.montant_inscription_nouveau" placeholder="0"
                            prepend-inner-icon="mdi-wallet-outline" density="compact" label="Inscription Nouveau"
                            readonly />
                        </VCol>

                        <VCol cols="12" md="3">
                          <VTextField v-model="association.montant_inscription_ancien" placeholder="0"
                            prepend-inner-icon="mdi-wallet-outline" density="compact" label="Inscription Ancien"
                            readonly />
                        </VCol>


                        <VCol cols="12" md="12">
                          <VTextarea v-model="association.description" placeholder="Description"
                            prepend-inner-icon="mdi-comment-outline" density="compact" label="Description...."
                            readonly />
                        </VCol>
                      </VRow>
                    </VWindowItem>
                  </VWindow>

                  <div class="d-flex justify-sm-space-between gap-4 flex-wrap justify-center mt-8">
                    <VBtn :color="currentStep === 0 ? 'secondary' : 'default'" variant="outlined"
                      :disabled="currentStep === 0" @click="currentStep--">
                      <VIcon icon="mdi-arrow-left" class="d-sm-none" />
                      <span class="d-none d-sm-block">
                        Précédent
                        <VIcon icon="mdi-arrow-left" end class="flip-in-rtl" />
                      </span>
                    </VBtn>


                    <VBtn v-if="iconsSteps.length - 1 === currentStep" color="error" @click="reset">
                      <VIcon icon="mdi-close-outline" class="d-sm-none" />
                      <span class="d-none d-sm-block">
                        Annuler <v-icon aria-hidden="false" class="mx-1">mdi-close-outline</v-icon>
                      </span>
                    </VBtn>


                    <VBtn v-else @click="currentStep++">
                      <VIcon icon="mdi-arrow-right" class="d-sm-none" />
                      <span class="d-none d-sm-block">
                        Continuer
                        <VIcon icon="mdi-arrow-right" end class="flip-in-rtl" />
                      </span>
                    </VBtn>
                  </div>
                </VForm>
              </VCardText>
            </VCard>
          </VDialog>
        </VCol>

        <VCol cols="12" md="10">
          <VTextField label="Recherchez quelque chose...." v-model="search" append-inner-icon="mdi-magnify"
            density="compact" />
        </VCol>
      </VRow>

      <VRow>
        <v-data-table :headers="headers" :items="associations" item-value="name" :search="search" :items-per-page="4">
          <!-- status -->
          <template #item.status="{ item }">
            <VChip :color="resolveStatusVariant(item.raw.status).color" class="font-weight-medium" size="small">
              {{ resolveStatusVariant(item.raw.status).text }}
            </VChip>
          </template>

          <!-- Actions -->
          <template #item.actions="{ item }">
            <div class="d-flex gap-1">

              <IconBtn @click="get(item.raw)">
                <VTooltip activator="parent" location="top">
                  Modier le association {{ item.raw.nom }}
                </VTooltip>
                <VIcon icon="mdi-pencil-outline" />
              </IconBtn>

              <IconBtn @click="desable(item.raw)" :class="item.raw.status != 'actif' ? 'd-none' : ''">
                <VTooltip activator="parent" location="top">
                  Désactiver le association {{ item.raw.nom }}
                </VTooltip>
                <VIcon icon="mdi-remove-circle-outline" />
              </IconBtn>

              <IconBtn @click="enable(item.raw)" :class="item.raw.status != 'inactif' ? 'd-none' : ''">
                <VTooltip activator="parent" location="top">
                  Réactiver le association {{ item.raw.nom }}
                </VTooltip>
                <VIcon icon="mdi-success-circle-outline" />
              </IconBtn>

              <IconBtn @click="consultation(item.raw)">
                <VTooltip activator="parent" location="top">
                  Consulter l'association {{ item.raw.nom }}
                </VTooltip>
                <VIcon icon="mdi-eye-outline" />
              </IconBtn>

              <IconBtn @click="deletes(item.raw)" disabled>
                <VTooltip activator="parent" location="top">
                  Supprimer le association {{ item.raw.nom }}
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
  import { VForm } from 'vuetify/components/VForm'


  export default {
    components: {
      VDataTable,
      VForm,
    },

    setup() {
      const toast = useToast();
      const search = ref('')
      const ajouter = ref(false)
      const modifier = ref(false)
      const consulter = ref(false)
      const currentStep = ref(0)
      const headers = [
        { title: 'ID', sortable: false, key: 'id', },
        { title: 'NOM', key: 'nom', },
        { title: 'SIGLE', key: 'sigle', },
        { title: 'STATUT', key: 'status', },
        { title: 'DATE DE CREATION', key: 'created_at', },
        { title: 'ACTIONS', sortable: false, key: 'actions', },
      ]
      const iconsSteps = [
        { tle: 'Account Details', on: 'custom-wizard-account', },
        { tle: 'Personal Info', on: 'custom-wizard-personal', },
        { tle: 'Personal Info', on: 'custom-wizard-personal', },
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
      const validaNewAssociationForm = () => {
        new_association.value?.validate().then(valid => {
          if (valid.valid) {
            currentStep.value++
            isCurrentStepValid.value = true
          } else {
            isCurrentStepValid.value = false
          }
        })
      }

      return {
        toast,
        search,
        headers,
        ajouter,
        modifier,
        consulter,
        iconsSteps,
        currentStep,
        resolveStatusVariant,
      }
    },

    data() {
      return {
        actif: false,
        inactif: false,
        associations: [],
        association: {
          id: '',
          raison_sociale: '',
          nom: '',
          sigle: '',
          slogant: '',
          filigramme: '',
          logo: '',
          facebook: '',
          twitter: '',
          linkedin: '',
          site_web: '',
          whatsapp: '',
          email: '',
          telephone: '237',
          entete_sms: '',
          solde_sms: 100,
          solde_email: 100,
          solde_whatsapp: 100,
          solde_telegram: 100,
          montant_inscription_nouveau: 5000,
          montant_inscription_ancien: 3000,
          taux_annuel: 5.5,
          description: 'Rien à signaler pour l\'instant.',
          status: '',
          created_at: ''
        },
        rules: {
          required: value => !!value || 'Désolé mais ce champ est obligatoire.',
          min: value => value.length >= 10 || 'Vous devez entré au moins 10 caractères',
          max: value => value.length <= 10 || 'Vous devez entré au plus 10 caractères',
          url: value => {
            const regex = /https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}/gm
            return regex.test(value) || 'Désolé mais le format de cette Url est invalide.'
          },
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
      this.getassociations();
    },

    methods: {
      async new_association() {
        try {
          const { valid } = this.$refs.new_association.validate();
          console.log(valid)
          if (this.$refs.new_association.validate()) {

            this.ajouter = false;
            Swal.fire({
              title: 'Êtes vous sûres ?',
              html: "Voulez vous <b> Enregistrer </b> l'association <b>  " + this.association.nom + "</b> ?",
              showDenyButton: true,
              showCancelButton: false,
              confirmButtonText: "Je le souhaite",
              denyButtonText: `Annuler`,
              cancelButtonText: `Annuler`,
            }).then((result) => {
              if (result.isConfirmed) {
                axios.post('new_association/', {
                  raison_sociale: this.association.raison_sociale,
                  nom: this.association.nom,
                  sigle: this.association.sigle,
                  slogant: this.association.slogant,
                  filigramme: this.association.filigramme,
                  facebook: this.association.facebook,
                  twitter: this.association.twitter,
                  linkedin: this.association.linkedin,
                  site_web: this.association.site_web,
                  whatsapp: this.association.whatsapp,
                  email: this.association.email,
                  telephone: this.association.telephone,
                  entete_sms: this.association.entete_sms,
                  solde_sms: this.association.solde_sms,
                  solde_email: this.association.solde_email,
                  solde_whatsapp: this.association.solde_whatsapp,
                  solde_telegram: this.association.solde_telegram,
                  montant_inscription_nouveau: this.association.montant_inscription_nouveau,
                  montant_inscription_ancien: this.association.montant_inscription_ancien,
                  taux_annuel: this.association.taux_annuel,
                  description: this.association.description
                }).then((response) => {
                  if (response.data.status === 408) {
                    this.toast.warning(response.data.alert, { position: 'top-right', duration: 7500 })
                  } else if (response.data.status === 409) {
                    this.toast.error(response.data.alert, { position: 'top-right', duration: 7500 })
                  } else if (response.data.status === 200) {
                    this.getassociations();
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

      async reset() {
        this.ajouter = false;
        this.modifier = false;
        this.consulter = false;
      },

      async get(data) {
        this.modifier = true;
        this.association.id = data.id;
        this.association.raison_sociale = data.raison_sociale;
        this.association.nom = data.nom;
        this.association.sigle = data.sigle;
        this.association.slogant = data.slogant;
        this.association.filigramme = data.filigramme;
        this.association.facebook = data.facebook;
        this.association.twitter = data.twitter;
        this.association.linkedin = data.linkedin;
        this.association.site_web = data.site_web;
        this.association.whatsapp = data.whatsapp;
        this.association.email = data.email;
        this.association.telephone = data.telephone;
        this.association.entete_sms = data.entete_sms;
        this.association.solde_sms = data.solde_sms;
        this.association.solde_email = data.solde_email;
        this.association.solde_whatsapp = data.solde_whatsapp;
        this.association.solde_telegram = data.solde_telegram;
        this.association.montant_inscription_nouveau = data.montant_inscription_nouveau;
        this.association.montant_inscription_ancien = data.montant_inscription_ancien;
        this.association.taux_annuel = data.taux_annuel;
        this.association.description = data.description;
        this.association.status = data.status;
        this.association.created_at = data.created_at;
      },

      async consultation(data) {
        this.consulter = true;
        this.association.id = data.id;
        this.association.raison_sociale = data.raison_sociale;
        this.association.nom = data.nom;
        this.association.sigle = data.sigle;
        this.association.slogant = data.slogant;
        this.association.filigramme = data.filigramme;
        this.association.facebook = data.facebook;
        this.association.twitter = data.twitter;
        this.association.linkedin = data.linkedin;
        this.association.site_web = data.site_web;
        this.association.whatsapp = data.whatsapp;
        this.association.email = data.email;
        this.association.telephone = data.telephone;
        this.association.entete_sms = data.entete_sms;
        this.association.solde_sms = data.solde_sms;
        this.association.solde_email = data.solde_email;
        this.association.solde_whatsapp = data.solde_whatsapp;
        this.association.solde_telegram = data.solde_telegram;
        this.association.montant_inscription_nouveau = data.montant_inscription_nouveau;
        this.association.montant_inscription_ancien = data.montant_inscription_ancien;
        this.association.taux_annuel = data.taux_annuel;
        this.association.description = data.description;
        this.association.status = data.status;
        this.association.created_at = data.created_at;
      },

      async update_association() {
        try {
          if (this.$refs.update_association.validate()) {
            this.modifier = false;
            Swal.fire({
              title: 'Êtes vous sûres ?',
              html: "Voulez vous <b> Modifier </b> le association <b>  " + this.association.nom + "</b> ?",
              showDenyButton: true,
              showCancelButton: false,
              confirmButtonText: "Je le souhaite",
              denyButtonText: `Annuler`,
              cancelButtonText: `Annuler`,
            }).then((result) => {
              if (result.isConfirmed) {
                axios.post('update_association/' + this.association.id, {
                  raison_sociale: this.association.raison_sociale,
                  nom: this.association.nom,
                  sigle: this.association.sigle,
                  slogant: this.association.slogant,
                  filigramme: this.association.filigramme,
                  facebook: this.association.facebook,
                  twitter: this.association.twitter,
                  linkedin: this.association.linkedin,
                  site_web: this.association.site_web,
                  whatsapp: this.association.whatsapp,
                  email: this.association.email,
                  telephone: this.association.telephone,
                  entete_sms: this.association.entete_sms,
                  solde_sms: this.association.solde_sms,
                  solde_email: this.association.solde_email,
                  solde_whatsapp: this.association.solde_whatsapp,
                  solde_telegram: this.association.solde_telegram,
                  montant_inscription_nouveau: this.association.montant_inscription_nouveau,
                  montant_inscription_ancien: this.association.montant_inscription_ancien,
                  taux_annuel: this.association.taux_annuel,
                  description: this.association.description
                }).then((response) => {
                  if (response.data.status === 408) {
                    this.toast.warning(response.data.alert, { position: 'top-right', duration: 7500 })
                  } else if (response.data.status === 409) {
                    this.toast.error(response.data.alert, { position: 'top-right', duration: 7500 })
                  } else if (response.data.status === 200) {
                    this.getassociations();
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

      async getassociations() {
        try {
          axios.get('association').then((response) => {
            this.associations = response.data;
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
          html: "Voulez vous <b>Déactivé</b> le association <b>" + data.nom.charAt(0).toUpperCase() + data.nom.slice(1) + " </b> ?",
          showDenyButton: true,
          showCancelButton: false,
          confirmButtonText: "Je le souhaite",
          denyButtonText: `Annuler`,
          cancelButtonText: `Annuler`,
        }).then((result) => {
          if (result.isConfirmed) {
            axios.post("on_association/" + data.id).then((response) => {
              if (response.data.status === 409) {
                this.toast.error(response.data.alert, { position: 'top-right', duration: 5000 });
              } else if (response.data.status === 200) {
                this.getassociations();
                this.toast.success(response.data.alert, { position: 'top-right', duration: 5000 });
              }
            });
          }

        })
      },

      async deletes(data) {
        Swal.fire({
          title: 'Êtes vous sûres ?',
          html: "Voulez vous <b>Supprimé</b> l'association <b>" + data.nom.charAt(0).toUpperCase() + data.nom.slice(1) + " </b> ?",
          showDenyButton: true,
          showCancelButton: false,
          confirmButtonText: "Je le souhaite",
          denyButtonText: `Annuler`,
          cancelButtonText: `Annuler`,
        }).then((result) => {
          if (result.isConfirmed) {
            const association = {
              id: data.id,
            };
            axios.post("delete_association/" + data.id).then((response) => {
              if (response.data.status === 409) {
                this.toast.error(response.data.alert, { position: 'top-right', duration: 5000 });
              } else if (response.data.status === 200) {
                this.getassociations();
                this.toast.success(response.data.alert, { position: 'top-right', duration: 5000 });
              }
            });
          }

        })
      },

      async desable(data) {
        Swal.fire({
          title: 'Êtes vous sûres ?',
          html: "Voulez vous <b>Désactiver</b> l'association <b>" + data.nom.charAt(0).toUpperCase() + data.nom.slice(1) + " </b> ? ",
          showDenyButton: true,
          showCancelButton: false,
          confirmButtonText: "Je le souhaite",
          denyButtonText: `Annuler`,
          cancelButtonText: `Annuler`,
        }).then((result) => {
          if (result.isConfirmed) {
            axios.post("off_association/" + data.id).then((response) => {
              if (response.data.status === 409) {
                this.toast.error(response.data.alert, { position: 'top-right', duration: 5000 });
              } else if (response.data.status === 200) {
                this.getassociations();
                this.toast.warning(response.data.alert, { position: 'top-right', duration: 5000 });
              }
            });
          }

        })
      },
    }
  }	
</script>
