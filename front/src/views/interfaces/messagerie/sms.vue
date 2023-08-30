<template>
  <VCard title="Système SMS" subtitle="Système d'envois des SMS personnalisés ">
    <VCardText>
      <VForm>
        <VRow>
          <VCol cols="12" md="12">
            <VAutocomplete label="Destinaraire" prepend-inner-icon="mdi-account-circle-outline" density="compact"
              :items="[]" />
          </VCol>

          <VCol cols="12">
            <VTextarea prepend-inner-icon="mdi-comment-outline" label="Message" rows="4" />
          </VCol>

          <VCol cols="12" md="12">
            <VBtn color="primary" type="submit" class="mx-2">
              <VIcon icon="mdi-content-save-all-outline" class="d-sm-none" />
              <span class="d-none d-sm-block">
                Transmettre <v-icon aria-hidden="false" class="mx-1">mdi-content-save-all-outline</v-icon>
              </span>
            </VBtn>

            <VBtn color="error" type="reset">
              <VIcon icon="mdi-close-outline" class="d-sm-none" />
              <span class="d-none d-sm-block">
                Annuler <v-icon aria-hidden="false" class="mx-1">mdi-close-outline</v-icon>
              </span>
            </VBtn>
          </VCol>
        </VRow>
      </VForm>
    </VCardText>
  </VCard>
</template>
