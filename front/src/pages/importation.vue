<template>
  <div>
      <VTabs v-model="activeTab" show-arrows class="v-tabs-pill">
          <VTab v-for="item in tabs" :key="item.icon" :value="item.tab">
              <VIcon size="20" start :icon="item.icon" /> {{ item.title }}
          </VTab>
      </VTabs>

      <VWindow v-model="activeTab" class="mt-5 disable-tab-transition">

          <!-- Email -->
          <VWindowItem value="agape">
              <AgapeInterface />
          </VWindowItem>

          <!-- Email -->
          <VWindowItem value="association">
              <AssociationInterface />
          </VWindowItem>

          <!-- Email -->
          <VWindowItem value="emprunt">
              <EmpruntInterface />
          </VWindowItem>

          <!-- Email -->
          <VWindowItem value="epargne">
              <EpargneInterface />
          </VWindowItem>

          <!-- Email -->
          <VWindowItem value="inscription">
              <InscriptionInterface />
          </VWindowItem>

          <!-- SMS -->
          <VWindowItem value="permission">
              <PermissionInterface />
          </VWindowItem>

          <!-- Whatsapp -->
          <VWindowItem value="rembourcement">
              <RembourcementInterface />
          </VWindowItem>

          <!-- Telegram -->
          <VWindowItem value="tontine">
              <TontineInterface />
          </VWindowItem>

          <!-- Telegram -->
          <VWindowItem value="utilisateur">
              <UtilisateurInterface />
          </VWindowItem>
      </VWindow>
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router'
import AgapeInterface from '@/views/interfaces/importation/agape.vue';
import AssociationInterface from '@/views/interfaces/importation/association.vue';
import EmpruntInterface from '@/views/interfaces/importation/emprunt.vue';
import EpargneInterface from '@/views/interfaces/importation/epargne.vue';
import InscriptionInterface from '@/views/interfaces/importation/inscription.vue';
import PermissionInterface from '@/views/interfaces/importation/permission.vue';
import RembourcementInterface from '@/views/interfaces/importation/rembourcement.vue';
import TontineInterface from '@/views/interfaces/importation/tontine.vue';
import UtilisateurInterface from '@/views/interfaces/importation/utilisateur.vue';

const route = useRoute()
const activeTab = ref(route.params.tab)
const tabs = [
  { title: 'Agapes', icon: 'mdi-notebook-edit-outline', tab: 'agape', },
  { title: 'Associations', icon: 'mdi-shield-home-outline', tab: 'association', },
  { title: 'Emprunts', icon: 'mdi-hands-pray', tab: 'emprunt', },
  { title: 'Epargnes', icon: 'mdi-checkbox-marked-circle-plus-outline', tab: 'epargne', },
  { title: 'Inscriptions', icon: 'mdi-account-hard-hat-outline', tab: 'inscription', },
  { title: 'Permissions', icon: 'mdi-shield-account-variant-outline', tab: 'permission', },
  { title: 'Rembourcements', icon: 'mdi-handshake', tab: 'rembourcement', },
  { title: 'Tontines', icon: 'mdi-currency-usd', tab: 'tontine', },
  { title: 'Utilisateurs', icon: 'mdi-account-group-outline', tab: 'utilisateur', },
]
</script>
