<template>
    <VCard title="Importation Empunts" subtitle="Module permettant d'importer la liste des Empunts. ">
        <VCardText>

            <VForm ref="newTontine" @submit.prevent="newTontine">
                <VCardText>
                    <VRow>
                        <VCol cols="12" md="10">
                            <VFileInput label="Sélectionnez le fichier" show-size counter prepend-icon=""
                                prepend-inner-icon="mdi-folder-open-outline" density="compact"
                                accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                        </VCol>
                        <VCol cols="12" md="2">
                            <VBtn color="primary" type="submit" block>
                                Importer <v-icon aria-hidden="false" class="mx-2">mdi-cloud-upload-outline</v-icon>
                            </VBtn>
                        </VCol>
                    </VRow>
                </VCardText>
            </VForm>

        </VCardText>
    </VCard>
</template>