<template>
	<div>
		<VTabs v-model="activeTab" show-arrows class="v-tabs-pill">
			<VTab v-for="item in tabs" :key="item.icon" :value="item.tab">
				<VIcon size="20" start :icon="item.icon" /> {{ item.title }}
			</VTab>
		</VTabs>

		<VWindow v-model="activeTab" class="mt-5 disable-tab-transition">


			<!-- SMS -->
			<VWindowItem value="module">
				<ModuleInterface />
			</VWindowItem>

			<!-- Email -->
			<VWindowItem value="role">
				<RoleInterface />
			</VWindowItem>

			<!-- Whatsapp -->
			<VWindowItem value="profil">
				<ProfileInterface />
			</VWindowItem>

			<!-- Telegram -->
			<VWindowItem value="permission">
				<PermissionInterface />
			</VWindowItem>

			<!-- Telegram -->
			<VWindowItem value="association">
				<AssociationInterface />
			</VWindowItem>
		</VWindow>
	</div>
</template>

<script setup>
import { useRoute } from 'vue-router'
import ModuleInterface from '@/views/interfaces/parametre/module.vue';
import ProfileInterface from '@/views/interfaces/parametre/profile.vue';
import RoleInterface from '@/views/interfaces/parametre/role.vue';
import PermissionInterface from '@/views/interfaces/parametre/permission.vue';
import AssociationInterface from '@/views/interfaces/parametre/association.vue';

const route = useRoute()
const activeTab = ref(route.params.tab)
const tabs = [
	{ title: 'Modules', icon: 'mdi-notebook-edit-outline', tab: 'module', },
	{ title: 'Profil', icon: 'mdi-monitor-account', tab: 'profil', },
	{ title: 'Rôles', icon: 'mdi-account-hard-hat-outline', tab: 'role', },
	{ title: 'Permissions', icon: 'mdi-shield-account-outline', tab: 'permission', },
	{ title: 'Associations', icon: 'mdi-home-group', tab: 'association', },
]
</script>
