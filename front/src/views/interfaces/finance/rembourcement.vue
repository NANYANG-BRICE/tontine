<template>
    <VCard class="mb-2">
        <VCardText>
            <VRow>
            </VRow>
        </VCardText>
    </VCard>

	<VCard>
        <VCardText>
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
                            <IconBtn @click="desableModule(item.raw)" :class="item.raw.status != 'actif' ? 'd-none' : ''">
                                <VTooltip activator="parent" location="top">
                                    Désactiver le module {{ item.raw.intilute }}
                                </VTooltip>
                                <VIcon icon="mdi-remove-circle-outline" />
                            </IconBtn>

                            <IconBtn @click="enableModule(item.raw)" :class="item.raw.status != 'inactif' ? 'd-none' : ''">
                                <VTooltip activator="parent" location="top">
                                    Réactiver le module {{ item.raw.intilute }}
                                </VTooltip>
                                <VIcon icon="mdi-success-circle-outline" />
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
        const isDialogVisible = ref(false)
        const isDialogVisible1 = ref(false)
        const headers = [
            { title: 'ID', sortable: false, key: 'id', },
            { title: 'N° EMPRUNT', key: 'nom', },
            { title: 'NOMS', key: 'nom', },
            { title: 'PRENOMS', key: 'prenom', },
            { title: 'ROLE', key: 'role', },
            { title: 'MONTANT', key: 'montant', },
            { title: 'DATE VERSEMENT', key: 'created_at', },
            { title: 'STATUT', key: 'status', },
            { title: 'ACTIONS', sortable: false, key: 'actions', },
        ]
        const resolveStatusVariant = status => {
            if (status === 'actif') { return { color: 'success', text: 'Actif', } }
            else { return { color: 'error', text: 'Inactif', } }
        }

        return {
            toast,
            search,
            headers,
            isDialogVisible,
            isDialogVisible1,
            resolveStatusVariant,
        }
    },
}

</script>