<template>
	<div>
		<VTabs v-model="activeTab" show-arrows class="v-tabs-pill">
			<VTab v-for="item in tabs" :key="item.icon" :value="item.tab">
				<VIcon size="20" start :icon="item.icon" /> {{ item.title }}
			</VTab>
		</VTabs>

		<VWindow v-model="activeTab" class="mt-5 disable-tab-transition">

			<!-- Email -->
			<VWindowItem value="utilisateur">
				<UtilisateurInterface />
			</VWindowItem>

			<!-- SMS -->
			<VWindowItem value="finance">
				<FinanceInterface />
			</VWindowItem>

			<!-- Whatsapp -->
			<VWindowItem value="messagerie">
				<MessagerieInterface />
			</VWindowItem>

			<!-- Telegram -->
			<VWindowItem value="generale">
				<GeneraleInterface />
			</VWindowItem>
		</VWindow>
	</div>
</template>

<script setup>
import { useRoute } from 'vue-router'
import UtilisateurInterface from '@/views/interfaces/statistique/utilisateur.vue';
import FinanceInterface from '@/views/interfaces/statistique/finance.vue';
import MessagerieInterface from '@/views/interfaces/statistique/messagerie.vue';
import GeneraleInterface from '@/views/interfaces/statistique/generale.vue';

const route = useRoute()
const activeTab = ref(route.params.tab)
const tabs = [
	{ title: 'Utilisateurs', icon: 'mdi-account-group-outline', tab: 'utilisateur', },
	{ title: 'Finances', icon: 'mdi-wallet-outline', tab: 'finance', },
	{ title: 'Messagerie', icon: 'mdi-message-outline', tab: 'messagerie', },
	{ title: 'Générales', icon: 'mdi-web', tab: 'generale', },
]
</script>
