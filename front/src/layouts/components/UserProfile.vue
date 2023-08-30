<script setup>
import avatar1 from '@images/avatars/avatar-1.png'
</script>

<template>
  <VBadge dot location="bottom right" offset-x="3" offset-y="3" color="success" bordered>
    <VAvatar class="cursor-pointer" color="primary" variant="tonal">
      <VImg :src="avatar1" />

      <!-- SECTION Menu -->
      <VMenu activator="parent" width="230" location="bottom end" offset="14px">
        <VList>
          <!-- 👉 User Avatar & Name -->
          <VListItem>
            <template #prepend>
              <VListItemAction start>
                <VBadge dot location="bottom right" offset-x="3" offset-y="3" color="success">
                  <VAvatar color="primary" variant="tonal">
                    <VImg :src="avatar1" />
                  </VAvatar>
                </VBadge>
              </VListItemAction>
            </template>

            <VListItemTitle class="font-weight-semibold">
              John Doe
            </VListItemTitle>
            <VListItemSubtitle>Admin</VListItemSubtitle>
          </VListItem>
          <VDivider class="my-2" />

          <!-- 👉 Settings -->
          <VListItem link to="/finance">
            <template #prepend>
              <VIcon class="me-2" icon="mdi-wallet-outline" size="22" />
            </template>

            <VListItemTitle>Finances</VListItemTitle>
          </VListItem>

          <!-- 👉 Settings -->
          <VListItem link to="/messagerie">
            <template #prepend>
              <VIcon class="me-2" icon="mdi-message-processing-outline" size="22" />
            </template>

            <VListItemTitle>Messagerie</VListItemTitle>
          </VListItem>

          <!-- 👉 Settings -->
          <VListItem link to="/importations">
            <template #prepend>
              <VIcon class="me-2" icon="mdi-cloud-upload-outline" size="22" />
            </template>

            <VListItemTitle>Importations</VListItemTitle>
          </VListItem>


          <!-- 👉 Settings -->
          <VListItem link to="/parametres">
            <template #prepend>
              <VIcon class="me-2" icon="mdi-cog-outline" size="22" />
            </template>

            <VListItemTitle>Paramètres</VListItemTitle>
          </VListItem>

          <!-- 👉 Pricing -->
          <VListItem link  to="/statistiques">
            <template #prepend>
              <VIcon class="me-2" icon="mdi-chart-timeline-variant-shimmer" size="22" />
            </template>

            <VListItemTitle>Statistiques</VListItemTitle>
          </VListItem>

          <!-- Divider -->
          <VDivider class="my-2" />

          <!-- 👉 Logout -->
          <VListItem to="/login">
            <template #prepend>
              <VIcon class="me-2" icon="mdi-logout" size="22" />
            </template>

            <VListItemTitle>Déconnexion</VListItemTitle>
          </VListItem>
        </VList>
      </VMenu>
      <!-- !SECTION -->
    </VAvatar>
  </VBadge>
</template>
