<template>
  <div>
      <VTabs v-model="activeTab" show-arrows class="v-tabs-pill">
          <VTab v-for="item in tabs" :key="item.icon" :value="item.tab">
              <VIcon size="20" start :icon="item.icon" /> {{ item.title }}
          </VTab>
      </VTabs>

      <VWindow v-model="activeTab" class="mt-5 disable-tab-transition">

          <VWindowItem value="inscription">
              <InscriptionInterface />
          </VWindowItem>

          <!-- Email -->
          <VWindowItem value="agape">
              <AgapeInterface />
          </VWindowItem>

          <!-- Email -->
          <VWindowItem value="tontine">
              <TontineInterface />
          </VWindowItem>

          <!-- Email -->
          <VWindowItem value="epargne">
              <EpargneInterface />
          </VWindowItem>

          <!-- Email -->
          <VWindowItem value="emprunt">
              <EmpruntInterface />
          </VWindowItem>

          <!-- Email -->
          <VWindowItem value="rembourcement">
              <RembourcementInterface />
          </VWindowItem>
      </VWindow>
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router'
import InscriptionInterface from '@/views/interfaces/finance/inscription.vue';
import AgapeInterface from '@/views/interfaces/finance/agape.vue';
import TontineInterface from '@/views/interfaces/finance/tontine.vue';
import EpargneInterface from '@/views/interfaces/finance/epargne.vue';
import EmpruntInterface from '@/views/interfaces/finance/emprunt.vue';
import RembourcementInterface from '@/views/interfaces/finance/rembourcement.vue';

const route = useRoute()
const activeTab = ref(route.params.tab)
const tabs = [
  { title: 'Inscriptions', icon: 'mdi-account-multiple-plus-outline', tab: 'inscription', },
  { title: 'Agapes', icon: 'mdi-shield-home-outline', tab: 'agape', },
  { title: 'Tontines', icon: 'mdi-account-group-outline', tab: 'tontine', },
  { title: 'Epargnes', icon: 'mdi-account-hard-hat-outline', tab: 'epargne', },
  { title: 'Emprunts', icon: 'mdi-notebook-edit-outline', tab: 'emprunt', },
  { title: 'Rembourcements', icon: 'mdi-handshake', tab: 'rembourcement', },
]
</script>
