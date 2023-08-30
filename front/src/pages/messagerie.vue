<template>
  <div>
    <VTabs v-model="activeTab" show-arrows class="v-tabs-pill">
      <VTab v-for="item in tabs" :key="item.icon" :value="item.tab">
        <VIcon size="20" start :icon="item.icon" /> {{ item.title }}
      </VTab>
    </VTabs>

    <VWindow v-model="activeTab" class="mt-5 disable-tab-transition">

      <!-- Email -->
      <VWindowItem value="email">
        <EmailInterface />
      </VWindowItem>

      <!-- SMS -->
      <VWindowItem value="sms">
        <SMSInterface />
      </VWindowItem>

      <!-- Whatsapp -->
      <VWindowItem value="whatsapp">
        <WhatsappInterface />
      </VWindowItem>

      <!-- Telegram -->
      <VWindowItem value="telegram">
        <TelegramInterface />
      </VWindowItem>
    </VWindow>
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router'
import SMSInterface from '@/views/interfaces/messagerie/sms.vue';
import EmailInterface from '@/views/interfaces/messagerie/email.vue';
import WhatsappInterface from '@/views/interfaces/messagerie/whatsapp.vue';
import TelegramInterface from '@/views/interfaces/messagerie/telegram.vue';

const route = useRoute()
const activeTab = ref(route.params.tab)
const tabs = [
  { title: 'email', icon: 'mdi-envelope-fast-outline', tab: 'email', },
  { title: 'sms', icon: 'mdi-message-processing-outline', tab: 'sms', },
  { title: 'whatsapp', icon: 'mdi-whatsapp', tab: 'whatsapp', },
  { title: 'telegram', icon: 'mdi-send-circle-outline', tab: 'telegram', },
]
</script>
